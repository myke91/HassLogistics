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
        $tps = TarrifParams::all();
        $tcs = TarrifCharge::all();
        $temp = TempInvoice::join('clients', 'clients.client_id', '=', 'temp_invoice.client_id')
                ->join('vessels', 'vessels.vessel_id', '=', 'temp_invoice.vessel_id')
                ->get();
        return view('invoicing.invoice', compact('clients', 'vessels', 'temp','tps','tcs'));
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
                Log::debug('returned id'.$id);
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
            $row['bill_item'] = $value[3];
            $row['billable'] = $value[4];
            $row['vat'] = $value[5];
            $row['unit_price'] = $value[6];
            $row['quantity'] = $value[7];
            $row['actual_cost'] = $value[8];
            $row['invoice_status'] = $value[9];
            $row['invoice_date'] = $value[10];
            Invoice::create($row);
            TempInvoice::destroy($value[11]);
        }
        $invoiceItems = Invoice::where(['client_id' => $client_id, 'vessel_id' => $vessel_id])->get();
        $clientDB = Client::where('client_id', '=', $client_id)->first();
        Log::debug($clientDB);
        Log::debug('invoice items');
        Log::debug($invoiceItems);
        $this->emailInvoice($clientDB->client_name, $clientDB->client_email, $vessel);
        $this->generateInvoicePdfStream();
    }

    public function deleteTempInvoice(Request $request) {

        if ($request->ajax()) {
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

    public function generateInvoicePdfStream() {
//        Log::debug('data for invoice');
//        Log::debug($data);
//        $data = ["invoice_id"=>1,"vessel_id"=>1,"client_id"=>1,"bill_item"=>"BULK GRAINS","billable"=>"1","unit_price"=>"2.00","quantity"=>365,"actual_cost"=>"730.00","vat"=>null,"invoice_status"=>1,"invoice_date"=>"2017-11-28","created_at"=>null,"updated_at"=>null                ]  ;
//        $data = [{"invoice_id":1,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"1","unit_price":"2.00","quantity":365,"actual_cost":"730.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":2,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":665,"actual_cost":"1330.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":3,"vessel_id":1,"client_id":1,"bill_item":"BULK CLINKER","billable":"PER TONNE","unit_price":"2.00","quantity":4653,"actual_cost":"9306.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":4,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":4353,"actual_cost":"8706.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":5,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":34346,"actual_cost":"68692.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":6,"vessel_id":1,"client_id":1,"bill_item":"BULK CLINKER","billable":"PER TONNE","unit_price":"2.00","quantity":34346,"actual_cost":"68692.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":7,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":76,"actual_cost":"152.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":8,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":76,"actual_cost":"152.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":9,"vessel_id":1,"client_id":1,"bill_item":"BULK CLINKER","billable":"PER TONNE","unit_price":"2.00","quantity":43,"actual_cost":"86.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":10,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":43,"actual_cost":"86.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":11,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":54,"actual_cost":"108.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":12,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":323,"actual_cost":"646.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":13,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":434,"actual_cost":"868.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":14,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":4334,"actual_cost":"8668.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":15,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":4334,"actual_cost":"8668.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":16,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":363,"actual_cost":"726.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":17,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":363,"actual_cost":"726.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":18,"vessel_id":1,"client_id":1,"bill_item":"BULK CLINKER","billable":"PER TONNE","unit_price":"2.00","quantity":363,"actual_cost":"726.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":19,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":64,"actual_cost":"128.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":20,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":46,"actual_cost":"92.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":21,"vessel_id":1,"client_id":1,"bill_item":"BULK BAUXITE","billable":"PER TONNE","unit_price":"1.00","quantity":4334,"actual_cost":"4334.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":22,"vessel_id":1,"client_id":1,"bill_item":"BULK MANGANESE","billable":"PER TONNE","unit_price":"1.00","quantity":243,"actual_cost":"243.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":23,"vessel_id":1,"client_id":1,"bill_item":"BULK MANGANESE","billable":"PER TONNE","unit_price":"1.00","quantity":43435,"actual_cost":"43435.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":24,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":4,"actual_cost":"8.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":25,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":54,"actual_cost":"108.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":26,"vessel_id":1,"client_id":1,"bill_item":"BULK CLINKER","billable":"PER TONNE","unit_price":"2.00","quantity":1111,"actual_cost":"2222.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":27,"vessel_id":1,"client_id":1,"bill_item":"BULK BAUXITE","billable":"PER TONNE","unit_price":"1.00","quantity":1111,"actual_cost":"1244.32","vat":"12.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":28,"vessel_id":1,"client_id":1,"bill_item":"BULK CLINKER","billable":"PER TONNE","unit_price":"2.00","quantity":12223,"actual_cost":"24446.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":29,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":596,"actual_cost":"2121.76","vat":"78.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":30,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":448,"actual_cost":"1102.08","vat":"23.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":31,"vessel_id":1,"client_id":1,"bill_item":"BULK BAUXITE","billable":"PER TONNE","unit_price":"1.00","quantity":6999,"actual_cost":"6999.00","vat":"23.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":32,"vessel_id":1,"client_id":1,"bill_item":"BULK MANGANESE","billable":"PER TONNE","unit_price":"1.00","quantity":8838,"actual_cost":"10782.36","vat":"22.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":33,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":434,"actual_cost":"868.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":34,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":4334,"actual_cost":"8668.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":35,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":4334,"actual_cost":"8668.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":36,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":363,"actual_cost":"726.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":37,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":363,"actual_cost":"726.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":38,"vessel_id":1,"client_id":1,"bill_item":"BULK CLINKER","billable":"PER TONNE","unit_price":"2.00","quantity":363,"actual_cost":"726.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":39,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":64,"actual_cost":"128.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":40,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":46,"actual_cost":"92.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":41,"vessel_id":1,"client_id":1,"bill_item":"BULK BAUXITE","billable":"PER TONNE","unit_price":"1.00","quantity":4334,"actual_cost":"4334.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":42,"vessel_id":1,"client_id":1,"bill_item":"BULK MANGANESE","billable":"PER TONNE","unit_price":"1.00","quantity":243,"actual_cost":"243.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":43,"vessel_id":1,"client_id":1,"bill_item":"BULK MANGANESE","billable":"PER TONNE","unit_price":"1.00","quantity":43435,"actual_cost":"43435.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":44,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":4,"actual_cost":"8.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":45,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":54,"actual_cost":"108.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":46,"vessel_id":1,"client_id":1,"bill_item":"BULK CLINKER","billable":"PER TONNE","unit_price":"2.00","quantity":1111,"actual_cost":"2222.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":47,"vessel_id":1,"client_id":1,"bill_item":"BULK BAUXITE","billable":"PER TONNE","unit_price":"1.00","quantity":1111,"actual_cost":"1244.32","vat":"12.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":48,"vessel_id":1,"client_id":1,"bill_item":"BULK CLINKER","billable":"PER TONNE","unit_price":"2.00","quantity":12223,"actual_cost":"24446.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":49,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":596,"actual_cost":"2121.76","vat":"78.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":50,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":448,"actual_cost":"1102.08","vat":"23.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":51,"vessel_id":1,"client_id":1,"bill_item":"BULK BAUXITE","billable":"PER TONNE","unit_price":"1.00","quantity":6999,"actual_cost":"6999.00","vat":"23.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":52,"vessel_id":1,"client_id":1,"bill_item":"BULK MANGANESE","billable":"PER TONNE","unit_price":"1.00","quantity":8838,"actual_cost":"10782.36","vat":"22.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":53,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":434,"actual_cost":"868.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-28","created_at":null,"updated_at":null},{"invoice_id":54,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":4334,"actual_cost":"8668.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":55,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":4334,"actual_cost":"8668.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":56,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":363,"actual_cost":"726.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":57,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":363,"actual_cost":"726.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":58,"vessel_id":1,"client_id":1,"bill_item":"BULK CLINKER","billable":"PER TONNE","unit_price":"2.00","quantity":363,"actual_cost":"726.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":59,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":64,"actual_cost":"128.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":60,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":46,"actual_cost":"92.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":61,"vessel_id":1,"client_id":1,"bill_item":"BULK BAUXITE","billable":"PER TONNE","unit_price":"1.00","quantity":4334,"actual_cost":"4334.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":62,"vessel_id":1,"client_id":1,"bill_item":"BULK MANGANESE","billable":"PER TONNE","unit_price":"1.00","quantity":243,"actual_cost":"243.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":63,"vessel_id":1,"client_id":1,"bill_item":"BULK MANGANESE","billable":"PER TONNE","unit_price":"1.00","quantity":43435,"actual_cost":"43435.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":64,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":4,"actual_cost":"8.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":65,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":54,"actual_cost":"108.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":66,"vessel_id":1,"client_id":1,"bill_item":"BULK CLINKER","billable":"PER TONNE","unit_price":"2.00","quantity":1111,"actual_cost":"2222.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":67,"vessel_id":1,"client_id":1,"bill_item":"BULK BAUXITE","billable":"PER TONNE","unit_price":"1.00","quantity":1111,"actual_cost":"1244.32","vat":"12.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":68,"vessel_id":1,"client_id":1,"bill_item":"BULK CLINKER","billable":"PER TONNE","unit_price":"2.00","quantity":12223,"actual_cost":"24446.00","vat":null,"invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":69,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":596,"actual_cost":"2121.76","vat":"78.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":70,"vessel_id":1,"client_id":1,"bill_item":"BULK GRAINS","billable":"PER TONNE","unit_price":"2.00","quantity":448,"actual_cost":"1102.08","vat":"23.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":71,"vessel_id":1,"client_id":1,"bill_item":"BULK BAUXITE","billable":"PER TONNE","unit_price":"1.00","quantity":6999,"actual_cost":"6999.00","vat":"23.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null},{"invoice_id":72,"vessel_id":1,"client_id":1,"bill_item":"BULK MANGANESE","billable":"PER TONNE","unit_price":"1.00","quantity":8838,"actual_cost":"10782.36","vat":"22.00","invoice_status":1,"invoice_date":"2017-11-29","created_at":null,"updated_at":null}];
        $this->_pdf = PDF::loadView('pdf.invoice', compact('data'));
        Log::debug('returning pdf document');
        return $this->_pdf->stream('invoice.pdf');
    }

    public function emailInvoice($client, $client_email, $vessel) {
        $input['client'] = $client;
        $input['client_email'] = $client_email;
        $input['vessel'] = $vessel;
        Mail::send('emails.invoice', $input, function($message) use ($input) {
            $message->to($input['client_email'], $input['client']);
            $message->subject('Invoice to '.$input['client'] . ' on vessel ' . $input['vessel']);
            $message->from('info@hasslogistics.com', 'Hass Logistics');
//            $message->attachData($this->_pdf->stream(), $input['client'] . '_' . $input['vessel'] . '_invoice.pdf');
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

}
