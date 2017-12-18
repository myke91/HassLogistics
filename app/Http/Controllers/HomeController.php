<?php

namespace HASSLOGISTICS\Http\Controllers;

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
        $clients = \HASSLOGISTICS\Client::all();
        $vessels = \HASSLOGISTICS\Vessel::join('Vessel_Operators', 'Vessel_Operators.vessel_operator_id', '=', 'Vessels.vessel_operator_id')->get();
        $audits = \HASSLOGISTICS\Audit::join('Users', 'Users.username', '=', 'Audit.user')->get();
        $totalClients = \HASSLOGISTICS\Client::count();
        $totalVessels = \HASSLOGISTICS\Vessel::count();

        return View::make('dashboard')
                        ->with(compact('clients'))
                        ->with(compact('vessels'))
                        ->with(compact('audits'))
                        ->with(compact('totalClients'))
                        ->with(compact('totalVessels'));
        ;
    }

}
