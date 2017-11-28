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
use Barryvdh\DomPDF\Facade as PDF;

class InvoiceController extends Controller {

    private $_pdf;

    public function prepareInvoice() {
        $clients = Client::all();
        $vessels = Vessel::all();
        $temp = TempInvoice::join('clients', 'clients.client_id', '=', 'temp_invoice.client_id')
                ->join('vessels', 'vessels.vessel_id', '=', 'temp_invoice.vessel_id')
                ->get();
        return view('invoicing.invoice', compact('clients', 'vessels', 'temp'));
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
            //return $request->all();
            try {
                TempInvoice::create($request->all());
            } catch (\Exception $ex) {
                return response()->json(['error' => 'An error occured']);
            }
        }
    }

    public function confirmAndSaveInvoice(Request $request) {

        if ($request->ajax())
        {
            return response(Invoice::create($request->all()));

        }
    }

    public function saveAllAndGenerateInvoice(Request $request) {
        $entries = $request->data;
        $client = $request->client;
        $vessel = $request->vessel;
        $client_id = '';
        $vessel_id = '';
        foreach ($entries as $value) {
            $row = array();
            $row['vessel_id'] = $value[0];
            $vessel_id = $value[0];
            $row['client_id'] = $value[1];
            $client_id = $value[1];
            $row['bill_item'] = $value[2];
            $row['vat'] = $value[3];
            $row['unit_price'] = $value[4];
            $row['quantity'] = $value[5];
            $row['actual_cost'] = $value[6];
            $row['invoice_status'] = $value[7];
            $row['invoice_date'] = $value[8];
            Invoice::create($row);
            TempInvoice::destroy($value[9]);
        }
        $invoiceItems = Invoice::where(['client_id' => $client_id, 'vessel_id' => $vessel_id])->get();
        $client_email = Client::where('client_id', '=', $client_id)->pluck('client_email');
//        $this->emailInvoice($client, $client_email, $vessel);
        $this->generateInvoicePdfStream($invoiceItems);
    }


    public function deleteTempInvoice(Request $request) {

        if ($request->ajax())
        {
            TempInvoice::destroy($request->invoice_id);
        }


    }

    public function getInvoiceInfo() {
        return view('invoicing.invoiceInfo');
    }

    public function showInvoiceInfo() {
        $invoices = $this->InvoiceInformation()->get();
        return view('invoicing.invoiceTable', compact('invoices'));
    }

    public function InvoiceInformation() {
        return Invoice::join('clients', 'clients.client_id', '=', 'invoice.client_id')
                        ->join('vessels', 'vessels.vessel_id', '=', 'invoice.vessel_id');
    }

    public function getInvoiceModification() {
        return view('invoicing.invoiceModification');
    }

    public function generateInvoicePdfStream($data) {
        Log::debug($data);
        $this->_pdf = PDF::loadView('pdf.invoice', compact('data'));
        Log::debug('returning pdf document');
        return $this->_pdf->download('invoice.pdf');
    }

    public function emailInvoice($client, $client_email, $vessel) {
        $data['client'] = $client;
        Mail::send('emails.invoice',$data , function($message) {
            $message->to('Client');
            $message->subject('Invoice to client');
            $message->from('Hass Logistics');
            $message->attachData($this->_pdf->stream(), '_invoice.pdf');
        });
    }

    public function editTempInvoice(Request $request)
    {
        if ($request->ajax()) {
            return response(TempInvoice::find($request->invoice_id));
        }
    }

    public function updateTempInvoice(Request $request) {
        if ($request->ajax()) {
            return response(TempInvoice::updateOrCreate(['invoice_id' => $request->invoice_id], $request->all()));
        }
    }

}
