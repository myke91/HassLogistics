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
        if(count($invoice_id)>0)
            return $this->payment('payment.payment', $invoice_id);

         else  return redirect()->back()->with(['error' =>'Invoice Id does not exit']);

    }

    public function savePayment(Request $request)
    {
        Payment::updateOrCreate(['payment_id' => $request->payment_id], $request->all());
        return back()->with(['success'=>'Payment saved successfully']);

    }

    public function savePaymentFromInvoice(Request $request)
    {
        if ($request->ajax())
        {
          return response(Payment::create($request->all()));
        }
    }

    public function getCashPayments()
    {
        $cash = Payment::where("payment_mode","Cash")
            ->join('vessels','vessels.vessel_id','=','payments.vessel_id')
            ->join('clients','clients.client_id','=','payments.client_id')
            ->join('users','users.id','=','payments.user_id')
            ->paginate(10);
        return view('payment.cashPayment',compact('cash'));
    }


    public function getChequePayments()
    {
        $cheques = Payment::where("payment_mode","Cheque")
            ->join('vessels','vessels.vessel_id','=','payments.vessel_id')
            ->join('clients','clients.client_id','=','payments.client_id')
            ->join('users','users.id','=','payments.user_id')
            ->paginate(10);
        return view('payment.chequePayment',compact('cheques'));
    }

    public function getPaymentOnAccount()
    {
        return view('payment.paymentOnAccount');
    }
    
      public function emailReceipt($client, $client_email, $vessel, $invoiceFileName) {
        $input['client'] = $client;
        $input['client_email'] = $client_email;
        $input['vessel'] = $vessel;
        $input['filename'] = $invoiceFileName;
        Mail::send('emails.invoice', $input, function($message) use ($input) {
            $message->to('gabbeyquaye@gmail.com', $input['client']);
            $message->subject('Invoice to ' . $input['client'] . ' on vessel ' . $input['vessel']);
            $message->from('info@hasslogistics.com', 'Hass Logistics');
            $message->attachData($this->_pdf->stream(), $input['filename']);
        });
    }
    
      public function downloadReceiptFile(Request $request) {
        return response()->download(storage_path('app/reciepts/' . $request->file));
    }
}
