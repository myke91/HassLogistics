<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Tarrif;
use App\TarrifType;
use App\TarrifCharge;
use App\Client;
use App\Vessel;
use App\TarrifParams;
use App\Invoice;
use App\TempInvoice;
use \Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;

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
            return response(Invoice::create($request->all()));
        }
    }

    public function saveAllAndGenerateInvoice(Request $request) {
        $entries = $request->data;
        $client_id = '';
        $vessel_id = '';
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
            $row['bill_item'] = $value[4];
            $row['billable'] = $value[5];
            $row['vat'] = $value[6];
            $row['unit_price'] = $value[7];
            $row['quantity'] = $value[8];
            $row['actual_cost'] = $value[9];
            $row['invoice_status'] = $value[11];
            $row['invoice_date'] = $value[12];
            Log::debug($row);
            Invoice::create($row);
            TempInvoice::destroy($value[13]);
        }
        $invoiceItems = Invoice::where(['client_id' => $client_id, 'vessel_id' => $vessel_id])->get();
        $clientDB = Client::where('client_id', '=', $client_id)->first();
        Log::debug($clientDB);
        Log::debug('invoice items');
        Log::debug($invoiceItems);
        $invoiceFileName = $this->generateInvoicePdfStream($client_id, $vessel_id, $clientDB->client_name, $vessel);
        $this->emailInvoice($clientDB->client_name, $clientDB->client_email, $vessel, $invoiceFileName);

        return response()->json(['invoice' => $invoiceFileName]);
    }

    public function clearTempInvoiceTable(Request $request) {
        $entries = $request->data;

        foreach ($entries as $value) {
            TempInvoice::destroy($value[13]);
        }
        return response()->json(['message' => 'Clear successful']);
    }

    public function deleteTempInvoice(Request $request) {

        if ($request->ajax()) {
            TempInvoice::destroy($request->invoice_id);
        }
    }

    public function getTrackPayments() {
        return view('invoicing.trackPayments');
    }

    public function getInvoiceInfo() {
        $invoices = $this->invoiceInformationSummary()->get();
        return view('invoicing.invoiceInfo', compact('invoices'));
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
        $this->_pdf = PDF::loadView('pdf.invoice', compact('data'));
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

    public function emailInvoice($client, $client_email, $vessel, $invoiceFileName) {
        $input['client'] = $client;
        $input['client_email'] = $client_email;
        $input['vessel'] = $vessel;
        $input['filename'] = $invoiceFileName;
        Mail::send('emails.invoice', $input, function($message) use ($input) {
            $message->to('mike_dugah@yahoo.com', $input['client']);
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
        return response()->download(storage_path('app/invoices/' . $request->file));
    }

}
