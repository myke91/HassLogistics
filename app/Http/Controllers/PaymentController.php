<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Client;
use App\Vessel;
use App\Payment;
use App\PaymentEntries;
use Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;

class paymentController extends Controller {

    public function getPayment() {
        $invoices = Payment::all();
        return view('payment.searchPayment', compact('invoices'));
    }

    public function show_invoice_status($invoiceNo) {
        Log::debug($invoiceNo);
        return Payment::join('clients', 'clients.client_id', '=', 'payments.client_id')
                        ->join('vessels', 'vessels.vessel_id', '=', 'payments.vessel_id')
                        ->where('payments.invoice_no', $invoiceNo);
    }

    public function payment($viewName, $invoice_no) {
        $invoices = Invoice::all();
        $invoice = $this->show_invoice_status($invoice_no)->first();
        $vessel = Vessel::where('vessel_id', $invoice->vessel_id)->get();
        return view($viewName, compact('invoice', 'client', 'vessel', 'invoices'))->with('invoice_no', $invoice_no);
    }

    public function showPayment(Request $request) {
        try {
            Log::debug($request);

//        if ($request->ajax()) {
            $invoice_no = $request->invoice_no;
            return $this->payment('payment.payment', $invoice_no);
//        }
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function savePayment(Request $request) {
        Payment::updateOrCreate(['payment_id' => $request->payment_id], $request->all());
        Payment::create($request->all());
        $receiptFileName = $this->generateReceiptPdfStream($request->client_id, $request->vessel_id);
        $this->emailReceipt($request->client_id, $request->vessel_id, $receiptFileName);
        return back()->with(['success' => 'Payment saved successfully']);
    }

    public function savePaymentFromInvoice(Request $request) {
        if ($request->ajax()) {
            return response(Payment::create($request->all()));
        }
    }

    public function getCashPayments() {
        $cash = Payment::where("payment_mode", "Cash")
                ->join('vessels', 'vessels.vessel_id', '=', 'payments.vessel_id')
                ->join('clients', 'clients.client_id', '=', 'payments.client_id')
                ->join('users', 'users.id', '=', 'payments.user_id')
                ->paginate(10);
        return view('payment.cashPayment', compact('cash'));
    }

    public function getChequePayments() {
        $cheques = Payment::where("payment_mode", "Cheque")
                ->join('vessels', 'vessels.vessel_id', '=', 'payments.vessel_id')
                ->join('clients', 'clients.client_id', '=', 'payments.client_id')
                ->join('users', 'users.id', '=', 'payments.user_id')
                ->paginate(10);
        return view('payment.chequePayment', compact('cheques'));
    }

    public function getPaymentOnAccount() {
        return view('payment.paymentOnAccount');
    }

    public function emailReceipt($client_id, $vessel_id, $invoiceFileName) {
        $vessel = Vessel::find($vessel_id);
        $client = Client::find($client_id);
        $input['client'] = $client->client_name;
        $input['client_email'] = $client->client_email;
        $input['vessel'] = $vessel->vessel_name;
        $input['filename'] = $invoiceFileName;
        Mail::send('emails.receipt', $input, function($message) use ($input) {
            $message->to('mike_dugah@yahoo.com', $input['client']);
            $message->subject('Payment receipt on vessel ' . $input['vessel']);
            $message->from('info@hasslogistics.com', 'Hass Logistics');
            $message->attachData($this->_pdf->stream(), $input['filename']);
        });
    }

    public function generateReceiptPdfStream($client_id, $vessel_id) {
        $data = Payment::join('vessels', 'vessels.vessel_id', '=', 'payments.vessel_id')
                        ->join('clients', 'clients.client_id', '=', 'payments.client_id')
                        ->where(['payments.client_id' => $client_id, 'payments.vessel_id' => $vessel_id])->get();
        $vessel = Vessel::find($vessel_id);
        $client = Client::find($client_id);

        Log::debug($data);
        $this->_pdf = PDF::loadView('pdf.receipt', compact('data'));
        Log::debug('returning pdf document');
        $receiptFileName = time() . '_' . $client->client_name . '_' . $vessel->vessel_name . '_receipt.pdf';
        Storage::disk('local')->put('receipts/' . $receiptFileName, $this->_pdf->output());
        $files = Storage::files('app/receipts');
        Log::debug($files);
        $numberOfFiles = sizeof($files);
        Log::debug('number of files' . $numberOfFiles);
        if ($numberOfFiles > 10) {
            Log::debug('cleaning up directory');
            $lastFile = end($files);
            Storage::delete($lastFile);
        }
        return $receiptFileName;
    }

    public function generateReceiptFile() {
        $data = Payment::join('vessels', 'vessels.vessel_id', '=', 'payments.vessel_id')
                        ->join('clients', 'clients.client_id', '=', 'payments.client_id')
                        ->where(['payments.client_id' => 1, 'payments.vessel_id' => 1])->get();
//        $vessel = Vessel::find(1);
//        $client = Client::find(1);

        Log::debug($data);
        $this->_pdf = PDF::loadView('pdf.receipt', compact('data'));
        Log::debug('returning pdf document');
        return $this->_pdf->stream();
    }

    public function downloadReceiptFile(Request $request) {
        return response()->download(storage_path('app/reciepts/' . $request->file));
    }

    public function processPaymentTrack(Request $request) {
        
    }

}
