<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use \Illuminate\Support\Facades\Log;
use App\Tarrif;
use App\Client;
use App\Vessel;
use View;

class InvoiceController extends Controller {

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

}
