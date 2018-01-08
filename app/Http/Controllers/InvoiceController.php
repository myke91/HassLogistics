<?php

namespace HASSLOGISTICS\Http\Controllers;

use Auth;
use Barryvdh\DomPDF\Facade as PDF;
use HASSLOGISTICS\Audit;
use HASSLOGISTICS\Client;
use HASSLOGISTICS\ExchangeRate;
use HASSLOGISTICS\Invoice;
use HASSLOGISTICS\InvoiceDetail;
use HASSLOGISTICS\InvoiceHeader;
use HASSLOGISTICS\Payment;
use HASSLOGISTICS\PaymentEntries;
use HASSLOGISTICS\Tarrif;
use HASSLOGISTICS\TarrifCharge;
use HASSLOGISTICS\TarrifParams;
use HASSLOGISTICS\TarrifType;
use HASSLOGISTICS\TempInvoice;
use HASSLOGISTICS\Vat;
use HASSLOGISTICS\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use \Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{

    private $_pdf;

    public function prepareInvoice()
    {
        $clients = Client::all();
        $vessels = Vessel::all();
        $tps = TarrifParams::all();
        $tcs = TarrifCharge::all();
        $exchangeRates = ExchangeRate::all();
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        $temp = TempInvoice::join('clients', 'clients.client_id', '=', 'temp_invoice.client_id')
            ->join('vessels', 'vessels.vessel_id', '=', 'temp_invoice.vessel_id')
            ->get();
        return view('invoicing.invoice', compact('clients', 'vessels', 'temp', 'tps', 'tcs', 'unapprovedInvoices', 'exchangeRates'));
    }

    public function getTarrifs()
    {
        $tarrifs = Tarrif::all();
        return response()->json($tarrifs);
    }

    public function getTarrifTypes(Request $request)
    {
        $id = $request->tarrif;
        Log::debug('Getting tarrif types for tarrif_id: ' . $id);
        return response()->json(Tarrif::find($id)->types()->get());
    }

    public function getTarrifParams(Request $request)
    {
        $id = $request->type;
        Log::debug('Getting tarrif params for tarrif_type_id: ' . $id);
        return response()->json(TarrifType::find($id)->params()->get());
    }

    public function getTarrifCharges(Request $request)
    {
        $id = $request->param;
        Log::debug('Getting tarrif charges for tarrif_param_id: ' . $id);
        return response()->json(TarrifParams::with('charges')->find($id));
    }

    public function getBillCharge(Request $request)
    {
        $id = $request->charge;
        Log::debug('Getting tarrif charges for tarrif_param_id: ' . $id);
        return response()->json(TarrifCharge::find($id));
    }

    public function saveInvoice(Request $request)
    {
        $data = $request->all();
        Log::debug('payload for saving invoice ');
        Log::debug($data);
        Log::debug($data['data']['client']);
    }

    public function createTempInvoice(Request $request)
    {
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

    public function confirmAndSaveInvoice(Request $request)
    {
        if ($request->ajax()) {
            Audit::create(['user' => Auth::user()->username, 'activity' => 'Created invoice with invoice number ' . $request->invoice_no, 'act_date' => date('Y-m-d'), 'act_time' => time()]);
            return response(Invoice::create($request->all()));
        }
    }

    public function saveAllAndGenerateInvoice(Request $request)
    {
        $entries = $request->data;
        $header = $request->header;
        $client_id = '';
        $vessel_id = '';
        $actual_cost = 0;
        Log::debug('entries in request');
        Log::debug($entries);
        Log::debug($request->header);
        $invoiceHeader = InvoiceHeader::create($header);
        foreach ($entries as $value) {
            $row = array();
            $vessel_id = $value[0];
            $vessel = $value[1];
            $client_id = $value[2];
            $row['bill_item'] = $value[4];
            $row['billable'] = $value[5];
            $row['unit_price'] = $value[6];
            $row['quantity'] = $value[7];
            $row['actual_cost'] = $value[8];
            $row['header_id'] = $invoiceHeader->invoice_header_id;
            $row['user'] = Auth::user()->fullname;
            $row['username'] = Auth::user()->username;
            $actual_cost += $row['actual_cost'];
            InvoiceDetail::create($row);
            TempInvoice::destroy($value[12]);
        }

        $client = Client::find($client_id);
        $invoiceFileName = $this->generateInvoicePdfStream($invoiceHeader->invoice_header_id, $invoiceHeader->client, $invoiceHeader->vessel);

        $invoiceHeader->user = Auth::user()->fullname;
        $invoiceHeader->username = Auth::user()->username;
        $invoiceHeader->invoice_status = false;
        $invoiceHeader->total_amount = $actual_cost;
        $invoiceHeader->invoice_file_name = $invoiceFileName;
        $invoiceHeader->invoice_currency = $client->client_currency;
        $invoiceHeader->save();

        $vat = Vat::find(1)->value;
        $added = $actual_cost / ($vat * 100);
        $totalCost = $added + $actual_cost;

        $payment = array();
        $payment['client_id'] = $client_id;
        $payment['vessel_id'] = $vessel_id;
        $payment['invoice_no'] = $invoiceHeader->invoice_no;
        $payment['actual_cost'] = $actual_cost;
        $payment['voyage_number'] = $invoiceHeader->voyage_number;
        $payment['payment_currency'] = $invoiceHeader->invoice_currency;
        $payment['total_cost'] = $totalCost;
        $payment['balance'] = $totalCost;
        Payment::create($payment);
        Audit::create(['user' => Auth::user()->username, 'activity' => 'Processed and generated invoice for client ' . $invoiceHeader->client . ' on vessel ' . $vessel, 'act_date' => date('Y-m-d'), 'act_time' => time()]);
        return response()->json(['invoice' => $invoiceFileName]);
    }

    public function clearTempInvoiceTable(Request $request)
    {
        $entries = $request->data;

        foreach ($entries as $value) {
            TempInvoice::destroy($value[12]);
        }
        return response()->json(['message' => 'Clear successful']);
    }

    public function deleteTempInvoice(Request $request)
    {

        if ($request->ajax()) {
            TempInvoice::destroy($request->invoice_id);
        }
    }

    public function getTrackPayments()
    {
        $clients = Client::all();
        $payEnts = PaymentEntries::join('clients', 'clients.client_id', '=', 'payment_entries.client_id')->get();
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        return view('invoicing.trackPayments')
            ->with(compact('clients'))
            ->with(compact('payEnts'))
            ->with(compact('unapprovedInvoices'));
    }

    public function getInvoiceInfo()
    {
        $invoices = $this->invoiceInformationSummary()->get();
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        return view('invoicing.invoiceInfo')
            ->with(compact('unapprovedInvoices'))
            ->with(compact('invoices'));
    }

    public function getInvoiceDetails(Request $request)
    {
        $header_id = $request->headerId;
        return InvoiceDetail::join('invoice_header', 'invoice_header.invoice_header_id', '=', 'invoice_details.header_id')
            ->where('invoice_details.header_id', '=', $header_id)
            ->get();
    }

    public function showInvoiceInfo()
    {
        $invoices = $this->invoiceInformationSummary()->get();
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        return view('invoicing.invoiceTable')
            ->with(compact('unapprovedInvoices'))
            ->with(compact('invoices'));
    }

    public function InvoiceInformation()
    {
        return InvoiceHeader::join('clients', 'clients.client_id', '=', 'invoice_header.client_id')
            ->join('vessels', 'vessels.vessel_id', '=', 'invoice_header.vessel_id')->get();
    }

    public function invoiceInformationSummary()
    {
        return InvoiceHeader::join('clients', 'clients.client_id', '=', 'invoice_header.client_id')
            ->join('vessels', 'vessels.vessel_id', '=', 'invoice_header.vessel_id');
    }

    public function getInvoiceModification()
    {
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        return view('invoicing.invoiceModification')
            ->with(compact('unapprovedInvoices'));
    }

    public function generateInvoicePdfStream($header_id, $client_name, $vessel_name)
    {
        $data = InvoiceHeader::join('invoice_details', 'invoice_details.header_id', '=', 'invoice_header.invoice_header_id')
            ->join('clients', 'clients.client_id', '=', 'invoice_header.client_id')
            ->join('vessels', 'vessels.vessel_id', '=', 'invoice_header.vessel_id')
            ->where('invoice_header.invoice_header_id', '=', $header_id)->get();
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

    public function generateInvoiceFile()
    {
        $data = InvoiceHeader::join('invoice_details', 'invoice_details.header_id', '=', 'invoice_header.invoice_header_id')
            ->join('clients', 'clients.client_id', '=', 'invoice_header.client_id')
            ->join('vessels', 'vessels.vessel_id', '=', 'invoice_header.vessel_id')
            ->get();
        Log::debug($data);
        $vat = \HASSLOGISTICS\Vat::find(1);
        $this->_pdf = PDF::loadView('pdf.invoice', compact('data'), compact('vat'));
        Log::debug('returning pdf document');
        return $this->_pdf->stream();
    }

    public function emailInvoice($client, $client_email, $vessel, $invoiceFileName)
    {
        $fs = Storage::disk('local')->getDriver();
        $input['client'] = $client;
        $input['client_email'] = $client_email;
        $input['vessel'] = $vessel;
        $input['filename'] = $invoiceFileName;
        $input['stream'] = $fs->readStream('invoices/' . $invoiceFileName);

        Mail::send('emails.invoice', $input, function ($message) use ($input) {
            $message->to('mike_dugah@yahoo.com', $input['client']);
            $message->subject('Invoice to ' . $input['client'] . ' on vessel ' . $input['vessel']);
            $message->from('info@hasslogistics.com', 'Hass Logistics');
            $message->attachData($input['stream'], $input['filename']);
        });
    }

    public function editTempInvoice(Request $request)
    {
        if ($request->ajax()) {
            return response(TempInvoice::find($request->invoice_id));
        }
    }

    public function updateTempInvoice(Request $request)
    {
        if ($request->ajax()) {
            return response(TempInvoice::updateOrCreate(['invoice_id' => $request->invoice_id], $request->all()));
        }
    }

    public function downloadInvoiceFile(Request $request)
    {
        Log::debug('entered download invoice function');
        return response()->download(storage_path('app/invoices/' . $request->file));
    }

    public function getUnapprovedInvoices()
    {
        $clients = Client::all();
        $vessels = Vessel::all();
        $tps = TarrifParams::all();
        $tcs = TarrifCharge::all();
        $exchangeRates = ExchangeRate::all();
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        $data = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->get();
        return view('invoicing.unapprovedInvoices', compact('clients', 'vessels', 'data', 'tps', 'tcs', 'unapprovedInvoices', 'exchangeRates'));

    }

    public function approveInvoice(Request $request)
    {
        $id = $request->id;
        $invoice = \HASSLOGISTICS\InvoiceHeader::find($id);
        if (Auth::user()->username != $invoice->username) {
            $client = \HASSLOGISTICS\Client::find($invoice->client_id);
            $invoice->is_approved = 1;
            $invoice->save();
            $this->emailInvoice($client->client_name, $client->client_email, $invoice->vessel, $invoice->invoice_file_name);
        } else {
            return response()->json('You cannot approve an invoice you prepared yourself', 403);
        }
    }

}
