<?php

namespace HASSLOGISTICS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use HASSLOGISTICS\Tarrif;
use HASSLOGISTICS\TarrifType;
use HASSLOGISTICS\TarrifCharge;
use HASSLOGISTICS\Client;
use HASSLOGISTICS\Vessel;
use HASSLOGISTICS\TarrifParams;
use HASSLOGISTICS\Invoice;
use HASSLOGISTICS\TempInvoice;
use HASSLOGISTICS\Vat;
use HASSLOGISTICS\Audit;
use HASSLOGISTICS\Payment;
use HASSLOGISTICS\PaymentEntries;
use \Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use Auth;

class InvoiceController extends Controller {

    private $_pdf;

    public function prepareInvoice() {
        $clients = Client::all();
        $vessels = Vessel::all();
        $tps = TarrifParams::all();
        $tcs = TarrifCharge::all();
        $temp = TempInvoice::join('clients', 'clients.client_id', '=', 'temp_invoice.client_id')
                ->join('vessels', 'vessels.vessel_id', '=', 'temp_invoice.vessel_id')
                ->get();
        return view('invoicing.invoice', compact('clients', 'vessels', 'temp', 'tps', 'tcs'));
    }

    public function getTarrifs() {
        $tarrifs = Tarrif::all();
        return response()->json($tarrifs);
    }

    public function getTarrifTypes(Request $request) {
        $id = $request->tarrif;
        Log::debug('Getting tarrif types for tarrif_id: ' . $id);
        return response()->json(Tarrif::find($id)->types()->get());
    }

    public function getTarrifParams(Request $request) {
        $id = $request->type;
        Log::debug('Getting tarrif params for tarrif_type_id: ' . $id);
        return response()->json(TarrifType::find($id)->params()->get());
    }

    public function getTarrifCharges(Request $request) {
        $id = $request->param;
        Log::debug('Getting tarrif charges for tarrif_param_id: ' . $id);
        return response()->json(TarrifParams::with('charges')->find($id));
    }

    public function getBillCharge(Request $request) {
        $id = $request->charge;
        Log::debug('Getting tarrif charges for tarrif_param_id: ' . $id);
        return response()->json(TarrifCharge::find($id));
    }

    public function saveInvoice(Request $request) {
        $data = $request->all();
        Log::debug('payload for saving invoice ');
        Log::debug($data);
        Log::debug($data['data']['client']);
    }

    public function createTempInvoice(Request $request) {
        if ($request->ajax()) {
            try {
                $model = TempInvoice::create($request->all());
                $id = $model->invoice_id;
                Log::debug('returned id' . $id);
                $temp = TempInvoice::join('clients', 'clients.client_id', '=', 'temp_invoice.client_id')
                                ->join('vessels', 'vessels.vessel_id', '=', 'temp_invoice.vessel_id')
                                ->where('temp_invoice.invoice_id', '=', $id)->first();
                Log::debug('returning to view');
                Log::debug($temp);
                return response()->json($temp);
            } catch (\Exception $ex) {
                return response()->json(['error' => 'An error occured' . $ex]);
            }
        }
    }

    public function confirmAndSaveInvoice(Request $request) {

        if ($request->ajax()) {
            Audit::create(['user' => Auth::user()->username, 'activity' => 'Created invoice with invoice number' . $request->invoice_no, 'act_date' => date(), 'act_time' => time()]);
            return response(Invoice::create($request->all()));
        }
    }

    public function saveAllAndGenerateInvoice(Request $request) {
        $entries = $request->data;
        $client_id = '';
        $vessel_id = '';
        $invoice_no = '';
        $actual_cost = 0;
        Log::debug(Auth::user());
        Log::debug('user full name ' . Auth::user()->fullname);
        Log::debug('user username ' . Auth::user()->username);
        Log::debug('entries in request');
        Log::debug($entries);
        foreach ($entries as $value) {
            $row = array();
            $row['vessel_id'] = $value[0];
            $vessel_id = $value[0];
            $vessel = $value[1];
            $row['client_id'] = $value[2];
            $client_id = $value[2];
            $row['invoice_no'] = $value[3];
            $invoice_no = $value[3];
            $row['bill_item'] = $value[4];
            $row['billable'] = $value[5];
            $row['unit_price'] = $value[6];
            $row['quantity'] = $value[7];
            $row['actual_cost'] = $value[8];
            $row['invoice_status'] = $value[10];
            $row['invoice_date'] = $value[11];
            $row['user'] = Auth::user()->fullname;
            $row['username'] = Auth::user()->username;
            $actual_cost += $row['actual_cost'] = $value[8];
            Log::debug($row);
            Invoice::create($row);
            TempInvoice::destroy($value[12]);
        }
        $invoiceItems = Invoice::where(['client_id' => $client_id, 'vessel_id' => $vessel_id])->get();
        $clientDB = Client::where('client_id', '=', $client_id)->first();
        Log::debug($clientDB);
        Log::debug('invoice items');
        Log::debug($invoiceItems);
        $invoiceFileName = $this->generateInvoicePdfStream($client_id, $vessel_id, $clientDB->client_name, $vessel);
        $this->emailInvoice($clientDB->client_name, $clientDB->client_email, $vessel, $invoiceFileName);

        $vat = Vat::find(1)->value;
        $added = $actual_cost / ($vat * 100);
        $totalCost = $added + $actual_cost;

        $payment = array();
        $payment['client_id'] = $client_id;
        $payment['vessel_id'] = $vessel_id;
        $payment['invoice_no'] = $invoice_no;
        $payment['actual_cost'] = $actual_cost;
        $payment['total_cost'] = $totalCost;
        $payment['balance'] = $totalCost;
        Payment::create($payment);
        Audit::create(['user' => Auth::user()->username, 'activity' => 'Processed and generated invoice for client' . $clientDB->client_name . 'on vessel' . $vessel, 'act_date' => date('Y-m-d'), 'act_time' => time()]);
        return response()->json(['invoice' => $invoiceFileName]);
    }

    public function clearTempInvoiceTable(Request $request) {
        $entries = $request->data;

        foreach ($entries as $value) {
            TempInvoice::destroy($value[12]);
        }
        return response()->json(['message' => 'Clear successful']);
    }

    public function deleteTempInvoice(Request $request) {

        if ($request->ajax()) {
            TempInvoice::destroy($request->invoice_id);
        }
    }

    public function getTrackPayments() {
        $clients = Client::all();
        $payEnts = PaymentEntries::join('clients','clients.client_id','=','payment_entries.client_id')->get();
        return view('invoicing.trackPayments', compact('clients','payEnts'));
    }

    public function getInvoiceInfo() {
        $invoices = $this->invoiceInformationSummary()->get();
        return view('invoicing.invoiceInfo', compact('invoices'));
    }

    public function getInvoiceDetails() {
        
    }

    public function showInvoiceInfo() {
        $invoices = $this->invoiceInformationSummary()->get();
        return view('invoicing.invoiceTable', compact('invoices'));
    }

    public function InvoiceInformation() {
        return Invoice::join('clients', 'clients.client_id', '=', 'invoice.client_id')
                        ->join('vessels', 'vessels.vessel_id', '=', 'invoice.vessel_id');
    }

    public function invoiceInformationSummary() {
        return Invoice::join('clients', 'clients.client_id', '=', 'invoice.client_id')
                        ->join('vessels', 'vessels.vessel_id', '=', 'invoice.vessel_id')
                        ->select('client_name', 'vessel_name', 'vessels.vessel_id')
                        ->groupBy('client_name', 'vessel_name', 'vessels.vessel_id');
    }

    public function getInvoiceModification() {
        return view('invoicing.invoiceModification');
    }

    public function generateInvoicePdfStream($client_id, $vessel_id, $client_name, $vessel_name) {
        $data = Invoice::join('vessels', 'vessels.vessel_id', '=', 'invoice.vessel_id')
                        ->join('clients', 'clients.client_id', '=', 'invoice.client_id')
                        ->where(['invoice.client_id' => $client_id, 'invoice.vessel_id' => $vessel_id])->get();
        Log::debug($data);
        $vat = \HASSLOGISTICS\Vat::find(1);
        $this->_pdf = PDF::loadView('pdf.invoice', compact('data'), compact('vat'));
        Log::debug('returning pdf document');
        $invoiceFileName = time() . '_' . $client_name . '_' . $vessel_name . '_invoice.pdf';
        Storage::disk('local')->put('invoices/' . $invoiceFileName, $this->_pdf->output());
        $files = Storage::files('app/invoices');
        Log::debug($files);
        $numberOfFiles = sizeof($files);
        Log::debug('number of files' . $numberOfFiles);
        if ($numberOfFiles > 10) {
            Log::debug('cleaning up directory');
            $lastFile = end($files);
            Storage::delete($lastFile);
        }
        return $invoiceFileName;
    }

    public function generateInvoiceFile() {
        $data = Invoice::join('vessels', 'vessels.vessel_id', '=', 'invoice.vessel_id')
                        ->join('clients', 'clients.client_id', '=', 'invoice.client_id')
                        ->where(['invoice.client_id' => 1, 'invoice.vessel_id' => 1])->get();
        Log::debug($data);
        $vat = \HASSLOGISTICS\Vat::find(1);
        $this->_pdf = PDF::loadView('pdf.invoice', compact('data'), compact('vat'));
        Log::debug('returning pdf document');
        return $this->_pdf->stream();
    }

    public function emailInvoice($client, $client_email, $vessel, $invoiceFileName) {
        $input['client'] = $client;
        $input['client_email'] = $client_email;
        $input['vessel'] = $vessel;
        $input['filename'] = $invoiceFileName;
        Mail::send('emails.invoice', $input, function($message) use ($input) {
            $message->to('henrietta.dadzie@hasslogistics.com', $input['client']);
            $message->subject('Invoice to ' . $input['client'] . ' on vessel ' . $input['vessel']);
            $message->from('info@hasslogistics.com', 'Hass Logistics');
            $message->attachData($this->_pdf->stream(), $input['filename']);
        });
    }

    public function editTempInvoice(Request $request) {
        if ($request->ajax()) {
            return response(TempInvoice::find($request->invoice_id));
        }
    }

    public function updateTempInvoice(Request $request) {
        if ($request->ajax()) {
            return response(TempInvoice::updateOrCreate(['invoice_id' => $request->invoice_id], $request->all()));
        }
    }

    public function downloadInvoiceFile(Request $request) {
        Log::debug('entered download invoice functoin');
        return response()->download(storage_path('app/invoices/' . $request->file));
    }

}
