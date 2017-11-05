<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vessel;
use App\Client;
use App\VesselOperator;
use View;

class VesselController extends Controller {

    public function addVessel() {
        $vesseloperator = VesselOperator::all();
        $clients = Client::all();
        return View::make('data.vessel.new_vessel')
                        ->with(compact('vesseloperator'))
                        ->with(compact('clients'));
    }

    public function createVesselOperator(Request $request) {
        if ($request->ajax()) {
            return response(VesselOperator::create($request->all()));
        }
    }

    public function createVessel(Request $request) {
        if ($request->ajax()) {
            return response(Vessel::create($request->all()));
        }
    }

    public function showVesselInformation() {
        $vessels = $this->VesselInformation()->get();
        return view('data.vessel.vesselInfo', compact('vessels'));
    }

    public function VesselInformation() {
        return Vessel::join('vessel_operators', 'vessel_operators.vessel_operator_id', '=', 'vessels.vessel_operator_id');
    }

    public function editVessel(Request $request) {
        if ($request->ajax()) {
            return response(Vessel::find($request->vessel_id));
        }
    }

    public function updateVessel(Request $request) {
        if ($request->ajax()) {
            return response(Vessel::updateOrCreate(['vessel_id' => $request->vessel_id], $request->all()));
        }
    }

    public function deleteVessel(Request $request) {
        if ($request->ajax()) {
            Vessel::destroy($request->vessel_id);
        }
    }

    public function findVesselByName(Request $request) {
        $name = $request->vessel_name;
        $result = Vessel::where('vessel_name', 'like', '%'.$name.'%')->get();
        return response()->json($result);
    }
}
