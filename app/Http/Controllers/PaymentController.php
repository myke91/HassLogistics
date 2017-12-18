<?php

namespace HASSLOGISTICS\Http\Controllers;

use Illuminate\Http\Request;
use HASSLOGISTICS\Invoice;
use HASSLOGISTICS\Client;
use HASSLOGISTICS\Vessel;
use HASSLOGISTICS\Payment;
use HASSLOGISTICS\PaymentEntries;
use HASSLOGISTICS\Audit;
use Auth;

use Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;

class paymentController extends Controller {

    public function getPayment() {
        $invoices = Payment::all();
        return view('payment.searchPayment', compact('invoices'));
    }

    public function retrieve_payment_info($invoiceNo) {
        Log::debug($invoiceNo);
        return Payment::join('clients', 'clients.client_id', '=', 'payments.client_id')
                        ->join('vessels', 'vessels.vessel_id', '=', 'payments.vessel_id')
                        ->where('payments.invoice_no', $invoiceNo);
    }

    public function payment($viewName, $invoice_no) {
        $invoices = Invoice::all();
        $payment = $this->retrieve_payment_info($invoice_no)->first();
        $vessel = Vessel::where('vessel_id', $payment->vessel_id)->get();
        return view($viewName, compact('payment', 'client', 'vessel', 'invoices'))->with('invoice_no', $invoice_no);
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
        Log::debug($request);
        $p =  Payment::findOrFail($request->payment_id);

        $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );
        
       

        $p->vessel_id=$request->vessel_id;
        $p->client_id=$request->client_id;
        $p->user=$request->user;
        $p->username=$request->username;
        $p->invoice_no=$request->invoice_no;
        $p->payment_mode=$request->payment_mode;
        $p->actual_cost=$request->actual_cost;
        $p->total_cost=$request->total_cost;
        $p->amount_paid=$request->amount_paid + $request->amount;
        $p->amount_in_words = $f->format($request->amount);
        $p->balance=$request->total_cost - $request->amount_paid;
        $p->discount=$request->discount;
        $p->description=$request->description;
        $p->remark=$request->remark;
        $p->payment_date=$request->payment_date;
        $p->account_name=$request->account_name;
        $p->account_number=$request->account_number;
        $p->cheque_date=$request->cheque_date;
        $p->update();

        $model = PaymentEntries::create($request->all());
        $model->amount_in_words = $f->format($request->amount);
        $model->update();
        $receiptFileName = $this->generateReceiptPdfStream($model->payment_entries_id,$request->client_id,$request->vessel_id);
        $this->emailReceipt($request->client_id, $request->vessel_id, $receiptFileName);
        Audit::create(['user' => Auth::user()->username, 'activity' => 'Received payment of GHS' . $request->amount_paid . ' for invoice number ' . $request->invoice_no, 'act_date' => date('Y-m-d'), 'act_time' => time()]);
        return response()->json(['receipt' => $receiptFileName]);
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
                ->get();
        return view('payment.cashPayment', compact('cash'));
    }

    public function getChequePayments() {
        $cheques = Payment::where("payment_mode", "Cheque")
                ->join('vessels', 'vessels.vessel_id', '=', 'payments.vessel_id')
                ->join('clients', 'clients.client_id', '=', 'payments.client_id')
                ->get();
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
            $message->to('henrietta.dadzie@hasslogistics.com', $input['client']);
            $message->subject('Payment receipt on vessel ' . $input['vessel']);
            $message->from('info@hasslogistics.com', 'Hass Logistics');
            $message->attachData($this->_pdf->stream(), $input['filename']);
        });
    }

    public function generateReceiptPdfStream($entry_id,$client_id,$vessel_id) {
$data = PaymentEntries::join('vessels','vessels.vessel_id','=','payment_entries.vessel_id')
->where('payment_entries.payment_entries_id','=',$entry_id)->first();

        $client = Client::find($client_id);
        $vessel = Vessel::find($vessel_id);
    // $data = array_push($data,$vessel->vessel_name);

        Log::debug($data);
        $this->_pdf = PDF::loadView('pdf.receipt', compact('data'),compact('client'));
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
        return response()->download(storage_path('app/receipts/' . $request->file));
    }

    public function processPaymentTrack(Request $request) {
        if ($request->ajax()) {
            return response(PaymentEntries::find($request->client_id));
        }
    }

}
