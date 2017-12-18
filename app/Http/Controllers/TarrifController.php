<?php

namespace HASSLOGISTICS\Http\Controllers;

use Illuminate\Http\Request;
use View;

use HASSLOGISTICS\Tarrif;
use HASSLOGISTICS\TarrifCharge;
use HASSLOGISTICS\TarrifParams;
use HASSLOGISTICS\TarrifType;
use HASSLOGISTICS\Audit;


class TarrifController extends Controller {

    public function getTarrifForm()
    {
      $tarrifs = Tarrif::all();
        return View::make('tarrif.tarrif.add_tarrif',compact('tarrifs'));
    }

    public function getTarrifTypeForm() {
        $tarrifs = Tarrif::all();
        $tarrifTypes = TarrifType::join('tarrif','tarrif.tarrif_id','=','tarrif_type.tarrif_id')->get();
        return view('tarrif.tarrif_type.add_tarrif_type',compact('tarrifs','tarrifTypes'));
    }

    public function getTarrifParamForm() {
        $tarrifTypes = TarrifType::all();
        $tarrifParams = TarrifParams::join('tarrif_type','tarrif_type.tarrif_type_id','=','tarrif_params.tarrif_type_id')
                                       ->get();
        return View::make('tarrif.tarrif_params.add_tarrif_param',compact('tarrifTypes','tarrifParams'));
    }

    public function getTarrifChargeForm(Request $request) {
        $tarriParams = TarrifParams::all();
        $tarrifCharges = TarrifCharge::join('tarrif_params','tarrif_params.tarrif_param_id','=','tarrif_charge.tarrif_param_id')
                                            ->get();
        return View::make('tarrif.tarrif_charges.add_tarrif_charge',compact('tarrifCharges','tarriParams'));
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
