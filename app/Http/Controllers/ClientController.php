<?php

namespace HASSLOGISTICS\Http\Controllers;

use Auth;
use HASSLOGISTICS\Audit;
use HASSLOGISTICS\Client;
use HASSLOGISTICS\ExchangeRate;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function addClient()
    {
        $exchangeRates = ExchangeRate::all();
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        return view('data.client.add_client')
            ->with(compact('unapprovedInvoices'))
            ->with(compact('exchangeRates'));
    }

    public function createClient(Request $request)
    {
        if ($request->ajax()) {
            Audit::create(['user' => Auth::user()->username, 'activity' => 'Created Client' . $request->client_name, 'act_date' => date('Y-m-d'), 'act_time' => time()]);
            return response(Client::create($request->all()));
        }
    }

    public function showClientInformation()
    {
        $clients = $this->ClientInformation();
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        return view('data.client.clientInfo')
            ->with(compact('unapprovedInvoices'))
            ->with(compact('clients'));
    }

    public function ClientInformation()
    {
        return Client::all();
    }

    public function editClient(Request $request)
    {
        if ($request->ajax()) {
            return response(Client::find($request->client_id));
        }
    }

    public function updateClient(Request $request)
    {
        if ($request->ajax()) {
            Audit::create(['user' => Auth::user()->username, 'activity' => 'Updated Client' . $request->client_name, 'act_date' => date('Y-m-d'), 'act_time' => time()]);
            return response(Client::updateOrCreate(['client_id' => $request->client_id], $request->all()));
        }
    }

    public function deleteClient(Request $request)
    {
        if ($request->ajax()) {
            Audit::create(['user' => Auth::user()->username, 'activity' => 'Deleted client' . $request->client_id, 'act_date' => date('Y-m-d'), 'act_time' => time()]);
            Client::destroy($request->client_id);
        }
    }

}
