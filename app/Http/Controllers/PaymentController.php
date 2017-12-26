<?php

namespace HASSLOGISTICS\Http\Controllers;

use Auth;
use Barryvdh\DomPDF\Facade as PDF;
use HASSLOGISTICS\Audit;
use HASSLOGISTICS\Client;
use HASSLOGISTICS\InvoiceHeader;
use HASSLOGISTICS\Payment;
use HASSLOGISTICS\PaymentEntries;
use HASSLOGISTICS\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use \Illuminate\Support\Facades\Storage;

class paymentController extends Controller
{

    public function getPayment()
    {
        $invoices = Payment::all();
        $clients = Client::all();
        $unapprovedInvoices = InvoiceHeader::where('is_approved', '=', 0)->count();
        return view('payment.searchPayment', compact('invoices', 'unapprovedInvoices', 'clients'));
    }

    public function retrieve_payment_info($invoice_no, $client_id, $vessel_id, $voyage_number)
    {
        Log::debug($invoice_no);
        return Payment::join('clients', 'clients.client_id', '=', 'payments.client_id')
            ->join('vessels', 'vessels.vessel_id', '=', 'payments.vessel_id')
            ->where('payments.invoice_no', $invoice_no)
            ->orWhere('payments.client_id', $client_id)
            ->orWhere('payments.vessel_id', $vessel_id)
            ->orWhere('vessels.voyage_number', $voyage_number);
    }

    public function payment($viewName, $invoice_no, $client_id, $vessel_id, $voyage_number)
    {
        $invoices = InvoiceHeader::all();
        $payment = $this->retrieve_payment_info($invoice_no, $client_id, $vessel_id, $voyage_number)->first();
        if($payment == null){
            return back();
        }
        $currencies = \HASSLOGISTICS\ExchangeRate::all();
        $vessel = Vessel::where('vessel_id', $payment->vessel_id)->get();
        $unapprovedInvoices = InvoiceHeader::where('is_approved', '=', 0)->count();
        return view($viewName, compact('payment', 'client', 'vessel', 'invoices','currencies', 'unapprovedInvoices'))->with('invoice_no', $invoice_no);
    }

    public function showPayment(Request $request)
    {
        try {
            Log::debug($request);
            $invoice_no = $request->invoice_no;
            $client_id = $request->client_id;
            $vessel_id = $request->vessel_id;
            $voyage_number = $request->voyage_number;
            return $this->payment('payment.payment', $invoice_no, $client_id, $vessel_id, $voyage_number);
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    public function savePayment(Request $request)
    {
        Log::debug($request);
        $p = Payment::findOrFail($request->payment_id);

        $f = new \NumberFormatter(locale_get_default(), \NumberFormatter::SPELLOUT);

        $p->vessel_id = $request->vessel_id;
        $p->client_id = $request->client_id;
        $p->user = $request->user;
        $p->username = $request->username;
        $p->invoice_no = $request->invoice_no;
        $p->payment_mode = $request->payment_mode;
        $p->actual_cost = $request->actual_cost;
        $p->total_cost = $request->total_cost;
        $p->amount_paid = $request->amount + $request->amount_paid;
        $p->amount_in_words = $f->format($request->amount);
        $p->balance = $request->balance;
        $p->discount = $request->discount;
        $p->description = $request->description;
        $p->remark = $request->remark;
        $p->payment_date = $request->payment_date;
        $p->account_name = $request->account_name;
        $p->account_number = $request->account_number;
        $p->cheque_date = $request->cheque_date;
        $p->update();

        $model = PaymentEntries::create($request->all());

        $receiptFileName = $this->generateReceiptPdfStream($model->payment_entries_id, $request->client_id, $request->vessel_id);
        // $this->emailReceipt($request->client_id, $request->vessel_id, $receiptFileName);
        Audit::create(['user' => Auth::user()->username, 'activity' => 'Received payment of ' . $request->amount_paid . ' for invoice number ' . $request->invoice_no, 'act_date' => date('Y-m-d'), 'act_time' => time()]);
        $model->amount_in_words = $f->format($request->amount);
        // $model->receipt_file_name = $receiptFileName;
        $model->update();
        return response()->json(['receipt' => $receiptFileName]);
    }

    public function savePaymentFromInvoice(Request $request)
    {
        if ($request->ajax()) {
            return response(Payment::create($request->all()));
        }
    }

    public function getCashPayments()
    {
        $unapprovedInvoices = InvoiceHeader::where('is_approved', '=', 0)->count();
        $cash = Payment::join('vessels', 'vessels.vessel_id', '=', 'payments.vessel_id')
            ->join('clients', 'clients.client_id', '=', 'payments.client_id')
            ->where("payment_mode", "Cash")->get();
        return view('payment.cashPayment', compact('cash', 'unapprovedInvoices'));
    }

    public function getChequePayments()
    {
        $unapprovedInvoices = InvoiceHeader::where('is_approved', '=', 0)->count();
        $cheques = Payment::where("payment_mode", "Cheque")
            ->join('vessels', 'vessels.vessel_id', '=', 'payments.vessel_id')
            ->join('clients', 'clients.client_id', '=', 'payments.client_id')
            ->get();
        return view('payment.chequePayment', compact('cheques', 'unapprovedInvoices'));
    }

    public function getPaymentOnAccount()
    {
        $clients = Client::all();
        $unapprovedInvoices = InvoiceHeader::where('is_approved', '=', 0)->count();
        return view('payment.paymentOnAccount', compact('clients','unapprovedInvoices'));
    }

    public function emailReceipt($client_id, $vessel_id, $invoiceFileName)
    {
        $vessel = Vessel::find($vessel_id);
        $client = Client::find($client_id);
        $input['client'] = $client->client_name;
        $input['client_email'] = $client->client_email;
        $input['vessel'] = $vessel->vessel_name;
        $input['filename'] = $invoiceFileName;
        Mail::send('emails.receipt', $input, function ($message) use ($input) {
            $message->to('henrietta.dadzie@hasslogistics.com', $input['client']);
            $message->subject('Payment receipt on vessel ' . $input['vessel']);
            $message->from('info@hasslogistics.com', 'Hass Logistics');
            $message->attachData($this->_pdf->stream(), $input['filename']);
        });
    }

    public function generateReceiptPdfStream($entry_id, $client_id, $vessel_id)
    {
        $data = PaymentEntries::join('vessels', 'vessels.vessel_id', '=', 'payment_entries.vessel_id')
            ->where('payment_entries.payment_entries_id', '=', $entry_id)->first();

        $client = Client::find($client_id);
        $vessel = Vessel::find($vessel_id);
        // $data = array_push($data,$vessel->vessel_name);

        Log::debug($data);
        $this->_pdf = PDF::loadView('pdf.receipt', compact('data'), compact('client'));
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

    public function generateReceiptFile()
    {
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

    public function downloadReceiptFile(Request $request)
    {
        return response()->download(storage_path('app/receipts/' . $request->file));
    }

    public function processPaymentTrack(Request $request)
    {
        if ($request->ajax()) {
            $client_id = $request->id;
            $payments = Payment::where('client_id', '=', $client_id)
                ->where('invoice_no', '!=', '')->get();
            return response()->json($payments);
        }
    }

}
