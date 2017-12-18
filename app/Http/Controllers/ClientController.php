<?php

namespace HASSLOGISTICS\Http\Controllers;

use Illuminate\Http\Request;
use HASSLOGISTICS\Client;
use Auth;
use HASSLOGISTICS\Audit;

class ClientController extends Controller {

    public function addClient() {

        return view('data.client.add_client');
    }

    public function createClient(Request $request) {
        if ($request->ajax()) {
            Audit::create(['user' => Auth::user()->username, 'activity' => 'Created Client' . $request->client_name, 'act_date' => date(), 'act_time' => time()]);
            return response(Client::create($request->all()));
        }
    }

    public function showClientInformation() {
        $clients = $this->ClientInformation();
        return view('data.client.clientInfo', compact('clients'));
    }

    public function ClientInformation() {
        return Client::all();
    }

    public function editClient(Request $request) {
        if ($request->ajax()) {
            return response(Client::find($request->client_id));
        }
    }

    public function updateClient(Request $request) {
        if ($request->ajax()) {
            Audit::create(['user' => Auth::user()->username, 'activity' => 'Updated Client' . $request->client_name, 'act_date' => date(), 'act_time' => time()]);
            return response(Client::updateOrCreate(['client_id' => $request->client_id], $request->all()));
        }
    }

    public function deleteClient(Request $request) {
        if ($request->ajax()) {
            Audit::create(['user' => Auth::user()->username, 'activity' => 'Deleted client' . $request->client_id, 'act_date' => date(), 'act_time' => time()]);
            Client::destroy($request->client_id);
        }
    }

}
