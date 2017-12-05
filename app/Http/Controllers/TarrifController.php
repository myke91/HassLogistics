<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

use App\Tarrif;
use App\TarrifCharge;
use App\TarrifParams;
use App\TarrifType;


class TarrifController extends Controller {

    public function getTarrifForm()
    {
      $tarrifs = Tarrif::all();
        return View::make('tarrif.tarrif.add_tarrif',compact('tarrifs'));
    }

    public function getTarrifTypeForm() {
        return View::make('tarrif.tarrif_type.add_tarrif_type');
    }

    public function getTarrifParamForm() {
        return View::make('tarrif.tarrif_params.add_tarrif_param');
    }

    public function getTarrifChargeForm(Request $request) {
        return View::make('tarrif.tarrif_charges.add_tarrif_charge');
    }

    public function saveTarrif(Request $request)
    {
        if($request->ajax())
        {
            return response(Tarrif::create($request->all()));
        }
    }

    public function editTarrif(Request $request)
    {
        if($request->ajax())
        {
            return response(Tarrif::find($request->tarrif_id));
        }
    }

    public function updateTarrif(Request $request)
    {
        if ($request->ajax())
        {
            return response(Tarrif::updateOrCreate(['tarrif_id' => $request->tarrif_id], $request->all()));
        }
    }
//==================================================================================
    public function saveTarrifType(Request $request)
    {
        if($request->ajax())
        {
            return response(TarrifType::create($request->all()));
        }
    }

    public function editTarrifType(Request $request)
    {
        if($request->ajax())
        {
            return response(TarrifType::find($request->tarrif_type_id));
        }
    }
    public function updateTarrifType(Request $request)
    {
        if ($request->ajax())
        {
            return response(TarrifType::updateOrCreate(['tarrif_type_id' => $request->tarrif_type_id], $request->all()));
        }
    }
//=====================================================================================
    public function saveTarrifParam(Request $request)
    {
        if($request->ajax())
        {
            return response(TarrifParams::create($request->all()));
        }
    }
    public function editTarrifParam(Request $request)
    {
        if($request->ajax())
        {
            return response(TarrifParams::find($request->tarrif_param_id));
        }
    }
    public function updateTarrifParam(Request $request)
    {
        if ($request->ajax())
        {
            return response(TarrifParams::updateOrCreate(['tarrif_param_id' => $request->tarrif_param_id], $request->all()));
        }
    }
//================================================================================
    public function saveTarrifCharge(Request $request)
    {
        if($request->ajax())
        {
            return response(TarrifCharge::create($request->all()));
        }
    }

    public function editTarrifCharge(Request $request)
    {
        if($request->ajax())
        {
            return response(TarrifCharge::find($request->tarrif_charge_id));
        }
    }
    public function updateTarrifCharge(Request $request)
    {
        if ($request->ajax()) {
            return response(TarrifCharge::updateOrCreate(['tarrif_charge_id' => $request->tarrif_charge_id], $request->all()));
        }
    }
}
