<?php

namespace App\Http\Controllers;

use View;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('authen');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $clients = \App\Client::all();
        $vessels = \App\Vessel::join('Vessel_Operators', 'Vessel_Operators.vessel_operator_id', '=', 'Vessels.vessel_operator_id')->get();
        $audits = \App\Audit::join('Users', 'Users.username', '=', 'Audit.user')->get();
        $totalClients = \App\Client::count();
        $totalVessels = \App\Vessel::count();

        return View::make('dashboard')
                        ->with(compact('clients'))
                        ->with(compact('vessels'))
                        ->with(compact('audits'))
                        ->with(compact('totalClients'))
                        ->with(compact('totalVessels'));
        ;
    }

}
