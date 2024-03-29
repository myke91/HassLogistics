<?php

namespace HASSLOGISTICS\Http\Controllers;

use HASSLOGISTICS\ExchangeRate;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    public function addExchangeRate()
    {
        $exchange_rates = ExchangeRate::all();
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        return view('data.exchange_rate.add_exchange_rate')
            ->with(compact('unapprovedInvoices'))
            ->with(compact('exchange_rates'));
    }

    public function createExchangeRate(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $rate = new ExchangeRate();

            if ($rate->validate($data)) {
                Audit::create(['user' => Auth::user()->username, 'activity' => 'Added exchange rate for currency' . $request->currency, 'act_date' => date('Y-m-d'), 'act_time' => time('H:i:s')]);
                return response(ExchangeRate::create($data));
            } else {
                $errors = $rate->errors();
                return response()->json($errors, 400);
            }
        }
    }

    public function showExchangeRate()
    {
        $exchange_rates = ExchangeRate::all();
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        return view('data.exchange_rate.exchange_rates')
            ->with(compact('unapprovedInvoices'))
            ->with(compact('exchange_rates'));
    }

    public function editExchangeRate(Request $request)
    {
        if ($request->ajax()) {
            return response(ExchangeRate::find($request->exchange_rate_id));
        }
    }

    public function updateExchangeRate(Request $request)
    {
        if ($request->ajax()) {
            Audit::create(['user' => Auth::user()->username, 'activity' => 'Update exchange rate for currency' . $request->currency, 'act_date' => date('Y-m-d'), 'act_time' => time('H:i:s')]);
            return response(ExchangeRate::updateOrCreate(['exchange_rate_id' => $request->exchange_rate_id], $request->all()));
        }
    }
}
