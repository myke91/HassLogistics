<?php

namespace HASSLOGISTICS\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use View;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('authen');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = \HASSLOGISTICS\Client::all();
        $vessels = \HASSLOGISTICS\Vessel::join('Vessel_Operators', 'Vessel_Operators.vessel_operator_id', '=', 'Vessels.vessel_operator_id')->get();
        $audits = \HASSLOGISTICS\Audit::join('Users', 'Users.username', '=', 'Audit.user')->get();
        $totalClients = \HASSLOGISTICS\Client::count();
        $totalVessels = \HASSLOGISTICS\Vessel::count();
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        $pendingPayments = \HASSLOGISTICS\Payment::select(\DB::raw('SUM(balance) AS total'))
            ->first()->total;
        $completedPayments = \HASSLOGISTICS\Payment::select(\DB::raw('SUM(amount_paid) AS total'))
            ->first()->total;

        return View::make('dashboard')
            ->with(compact('clients'))
            ->with(compact('vessels'))
            ->with(compact('audits'))
            ->with(compact('totalClients'))
            ->with(compact('unapprovedInvoices'))
            ->with(compact('totalVessels'))
            ->with(compact('pendingPayments'))
            ->with(compact('completedPayments'));

    }

    public function paymentSummary(Request $request)
    {
        $range = $request->val;
        if ($range == 'first-quarter') {
            $pendingPayments = \DB::select(\DB::raw('select SUM(balance) AS total from payments where QUARTER(created_at) = 1'))
            ;

            $completedPayments = \DB::select(\DB::raw('select SUM(amount_paid) AS total from payments where QUARTER(created_at) = 1'))
            ;

            Log::debug('pending payments ' . $pendingPayments);
            Log::debug('completed payments ' . $completedPayments);

            return response()->json(['pendingPayments' => $pendingPayments, 'completedPayments' => $completedPayments]);
        } else if ($range == 'second-quarter') {
            $pendingPayments = \DB::select(\DB::raw('select SUM(balance) AS total from payments where QUARTER(created_at) = 2'))
            ;

            $completedPayments = \DB::select(\DB::raw('select SUM(amount_paid) AS total from payments where QUARTER(created_at) = 2'))
            ;

            Log::debug('pending payments ' . $pendingPayments);
            Log::debug('completed payments ' . $completedPayments);

            return response()->json(['pendingPayments' => $pendingPayments, 'completedPayments' => $completedPayments]);
        } else if ($range == 'third-quarter') {
            $pendingPayments = \DB::select(\DB::raw('select SUM(balance) AS total from payments where QUARTER(created_at) = 3'))->{'total'};

            $completedPayments = \DB::select(\DB::raw('select SUM(amount_paid) AS total from payments where QUARTER(created_at) = 3'))->{'total'};

            Log::debug('pending payments ' . $pendingPayments);
            Log::debug('completed payments ' . $completedPayments);

            return response()->json(['pendingPayments' => $pendingPayments, 'completedPayments' => $completedPayments]);
        } else if ($range == 'fourth-quarter') {
            $pendingPayments = \DB::select(\DB::raw('select SUM(balance) AS total from payments where QUARTER(created_at) = 4'))
            ;

            $completedPayments = \DB::select(\DB::raw('select SUM(amount_paid) AS total from payments where QUARTER(created_at) = 4'))
            ;

            Log::debug('pending payments ' . $pendingPayments);
            Log::debug('completed payments ' . $completedPayments);

            return response()->json(['pendingPayments' => $pendingPayments, 'completedPayments' => $completedPayments]);
        }

    }

}
