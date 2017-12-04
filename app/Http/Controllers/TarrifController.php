<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

class TarrifController extends Controller {

    public function getTarrifForm() {
        return View::make('tarrif.tarrif.add_tarrif');
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

    public function saveTarrif(Request $request) {
        return View::make('tarrif.tarrif_charges.add_tarrif_charge');
    }

    public function saveTarrifType(Request $request) {
        return View::make('tarrif.tarrif_charges.add_tarrif_charge');
    }

    public function saveTarrifParam(Request $request) {
        return View::make('tarrif.tarrif_charges.add_tarrif_charge');
    }

    public function saveTarrifCharge(Request $request) {
        return View::make('tarrif.tarrif_charges.add_tarrif_charge');
    }

}
