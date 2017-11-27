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
use Barryvdh\DomPDF\Facade as PDF;
use View;

class InvoiceController extends Controller {
private $_pdf;
    public function prepareInvoice() {
        $clients = Client::all();
        $vessels = Vessel::all();
        return View::make('invoicing/invoice')
                        ->with(compact('clients'))
                        ->with(compact('vessels'));
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

    public function createInvoice(Request $request) {
        if ($request->ajax()) {
            //return $request->all();
            return response(\App\TempInvoice::create($request->all()));
        }
    }

    public function confirmAndSaveInvoice(Request $request) {
        emailInvoice();
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

    public function generateInvoicePdfStream() {
        $data = ['invoiceNumber' => '453433534'];
        Log::debug($data);
        $this->_pdf = PDF::loadView('pdf.invoice', compact('data'));
        return  $this->_pdf->stream();
    }
    
    public function emailInvoice(){
        Mail::send('emails.welcome', $data, function($message) use ($input) {
            $message->to('mail@domain.net');
            $message->subject("Invoice to $client on vessel $vessel");
            $message->from('sender@domain.net');
            $message->attachData($this->_pdf->stream(), $client.'_'.$vessel.'invoice.pdf');
        });
    }

}
