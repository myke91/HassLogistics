<?php

namespace HASSLOGISTICS\Http\Controllers;

use Illuminate\Http\Request;
use HASSLOGISTICS\Vessel;
use HASSLOGISTICS\Client;
use HASSLOGISTICS\VesselOperator;
use HASSLOGISTICS\Audit;
use HASSLOGISTICS\Invoice;
use View;
use Auth;
use Illuminate\Support\Facades\Log;

class VesselController extends Controller {

    public function addVessel() {
        $vesseloperator = VesselOperator::all();
        $clients = Client::all();
        return View::make('data.vessel.new_vessel')
                        ->with(compact('vesseloperator'))
                        ->with(compact('clients'));
    }

    public function addVesselOperator() {
        $vesseloperators = VesselOperator::all();
        return view('data.vessel_operators.add_vessel_operator', compact('vesseloperators'));
    }

    public function createVesselOperator(Request $request) {
        if ($request->ajax()) {
            $data = $request->all();
            $vessel = new VesselOperator();

            if ($vessel->validate($data)) {
                return response(VesselOperator::create($data));
            } else {
                $errors = $vessel->errors();
                return response()->json($errors, 400);
            }
        }
    }

    public function createVessel(Request $request) {
        if ($request->ajax()) {
            try {
                $data = $request->all();
                $vessel = new Vessel();

                if ($vessel->validate($data)) {
                    Audit::create(['user' => Auth::user()->username, 'activity' => 'Created Vessel ' . $request->vessel_name, 'act_date' => date('Y-m-d'), 'act_time' => date('H:i:s')]);
                    return response(Vessel::create($data));
                } else {
                    $errors = $vessel->errors();
                    return response()->json($errors, 400);
                }
            } catch (\Illuminate\Database\QueryException $ex) {

                Log::debug($ex);
                return response()->json(['error' => 'An error occured'], 500);
            }
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
            return response(VesselOperator::find($request->vessel_operator_id));
        }
    }

    public function updateVessel(Request $request) {
        if ($request->ajax()) {
            Audit::create(['user' => Auth::user()->username, 'activity' => 'Updated Vessel' . $request->vessel_name, 'act_date' => date(), 'act_time' => time()]);
            return response(Vessel::updateOrCreate(['vessel_id' => $request->vessel_id], $request->all()));
        }
    }

    public function updateVesselOperator(Request $request) {
        if ($request->ajax()) {
             Audit::create(['user' => Auth::user()->username, 'activity' => 'Update vessel operator' . $request->operator_name, 'act_date' => date(), 'act_time' => time()]);
            return response(VesselOperator::updateOrCreate(['vessel_operator_id' => $request->vessel_operator_id], $request->all()));
        }
    }

    public function deleteVessel(Request $request) {
        if ($request->ajax()) {
            Audit::create(['user' => Auth::user()->username, 'activity' => 'Deleted Vessel' . $request->vessel_name, 'act_date' => date(), 'act_time' => time()]);
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

    public function getVesselsForClient(Request $request) {
        $id = $request->id;
        $vesselIds = Invoice::pluck('vessel_id')->all();
        return Vessel::join('clients', 'clients.client_id', '=', 'vessels.vessel_owner')
                        ->where('client_id', '=', $id)
                        ->whereNotIn('vessel_id', $vesselIds)
                        ->get();
    }

}
