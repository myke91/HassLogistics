<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    public function addClient()
    {

        return view('data.client.add_client');
    }
    public function createClient(Request $request)
    {
        if($request->ajax())
        {
            return response(Client::create($request->all()));
        }
    }
    public function showClientInformation()
    {
        $clients= $this->ClientInformation()->get();
        return view('data.client.clientInfo',compact('clients'));
    }

    public function ClientInformation()
    {
        return Client();
    }
    public function editClient(Request $request)
    {
        if($request->ajax())
        {
            return response(Client::find($request->client_id));
        }
    }
    public function updateClient(Request $request)
    {
        if($request->ajax())
        {
            return response(Client::updateOrCreate(['client_id'=>$request->client_id],$request->all()));
        }
    }
    public function deleteClient(Request $request)
    {
        if($request->ajax())
        {
            Client::destroy($request->client_id);
        }
    }

}
