<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Client;
use App\Vessel;
use App\Payment;

class paymentController extends Controller
{
    public function getPayment()
    {

        return view('payment.searchPayment');
    }

    public function show_invoice_status($invoiceId)
    {
        return Invoice::join('Clients','Clients.client_id','=','Invoice.client_id')
                        ->join('Vessels','Vessels.vessel_id','=','Invoice.vessel_id')
                        ->where('Invoice.Invoice_id',$invoiceId);
    }
    public function payment($viewName,$invoice_id)
    {
        $invoice = $this->show_invoice_status($invoice_id)->first();
        $vessel = Vessel::where('vessel_id',$invoice->vessel_id)->get();
        return view($viewName,compact('invoice','client','vessel'))->with('invoice_id',$invoice_id);
    }
    public function showPayment(Request $request)
    {
        $invoice_id = $request->invoice_id;
        return $this->payment('payment.payment',$invoice_id);
    }

    public function savePayment(Request $request)
    {
        Payment::create($request->all());
        return back()->with(['success'=>'Payment saved successfully']);

    }

    public function getCashPayments()
    {
        return view('payment.cashPayment');
    }

    public function getChequePayments()
    {
        return view('payment.chequePayment');
    }

    public function getPaymentOnAccount()
    {
        return view('payment.paymentOnAccount');
    }
}
