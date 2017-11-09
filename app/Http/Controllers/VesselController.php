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

    public function addVesselOperator() {
        return view('data.vessel_operators.add_vessel_operator');
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
        $vessels = $this->vesselInformation()->get();
        return view('data.vessel.vesselInfo', compact('vessels'));
    }

    public function showVesselOperators() {
        $vessel_operators = VesselOperator::all();
        return view('data.vessel_operators.vessel_operators', compact('vessel_operators'));
    }

    public function vesselInformation() {
        return Vessel::join('vessel_operators', 'vessel_operators.vessel_operator_id', '=', 'vessels.vessel_operator_id')
                        ->join('clients', 'clients.client_id', '=', 'vessels.vessel_owner');
    }

    public function editVessel(Request $request) {
        if ($request->ajax()) {
            return response(Vessel::find($request->vessel_id));
        }
    }

    public function editVesselOperator(Request $request) {
        if ($request->ajax()) {
            return response(VesselOperator::find($request->client_id));
        }
    }

    public function updateVessel(Request $request) {
        if ($request->ajax()) {
            return response(Vessel::updateOrCreate(['vessel_id' => $request->vessel_id], $request->all()));
        }
    }

    public function updateVesselOperator(Request $request) {
        if ($request->ajax()) {
            return response(VesselOperator::updateOrCreate(['vessel_operator_id' => $request->vessel_operator_id], $request->all()));
        }
    }

    public function deleteVessel(Request $request) {
        if ($request->ajax()) {
            Vessel::destroy($request->vessel_id);
        }
    }

    public function findVesselByName(Request $request) {
        $name = $request->vessel_name;
        $result = Vessel::where('vessel_name', 'like', '%' . $name . '%')->get();
        return response()->json($result);
    }

    public function getVesselDetail(Request $request) {
        return response()->json(Vessel::find($request->vessel_id));
    }

}
