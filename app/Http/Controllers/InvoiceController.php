<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

}
