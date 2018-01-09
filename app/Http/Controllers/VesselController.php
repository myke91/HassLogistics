<?php

namespace HASSLOGISTICS\Http\Controllers;

use Auth;
use HASSLOGISTICS\Audit;
use HASSLOGISTICS\Client;
use HASSLOGISTICS\Vessel;
use HASSLOGISTICS\VesselOperator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use View;

class VesselController extends Controller
{

    public function addVessel()
    {
        $vesseloperator = VesselOperator::all();
        $clients = Client::all();
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        return View::make('data.vessel.new_vessel')
            ->with(compact('vesseloperator'))
            ->with(compact('clients'))
            ->with(compact('unapprovedInvoices'));
    }

    public function addVesselOperator()
    {

        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        return view('data.vessel_operators.add_vessel_operator', compact('unapprovedInvoices'));
    }

    public function createVesselOperator(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = $request->all();
                $vessel = new VesselOperator();

                if ($vessel->validate($data)) {
                    return response(VesselOperator::create($data));
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

    public function createVessel(Request $request)
    {
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

    public function showVesselInformation()
    {
        $vessels = $this->vesselInformation()->get();
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        return view('data.vessel.vesselInfo', compact('vessels', 'unapprovedInvoices'));
    }

    public function showVesselOperators()
    {
        $vessel_operators = $this->VesselOperatorInfo();
        $unapprovedInvoices = \HASSLOGISTICS\InvoiceHeader::where('is_approved', '=', 0)->count();
        return view('data.vessel_operators.vessel_operators', compact('vessel_operators', 'unapprovedInvoices'));
    }

    public function VesselOperatorInfo()
    {
        return VesselOperator::all();
    }
    public function vesselInformation()
    {
        return Vessel::join('vessel_operators', 'vessel_operators.vessel_operator_id', '=', 'vessels.vessel_operator_id')
            ->join('clients', 'clients.client_id', '=', 'vessels.vessel_owner');
    }

    public function editVessel(Request $request)
    {
        if ($request->ajax()) {
            return response(Vessel::find($request->vessel_id));
        }
    }

    public function editVesselOperator(Request $request)
    {
        if ($request->ajax()) {
            return response(VesselOperator::find($request->vessel_operator_id));
        }
    }

    public function updateVessel(Request $request)
    {
        if ($request->ajax()) {
            Audit::create(['user' => Auth::user()->username, 'activity' => 'Updated Vessel ' . $request->vessel_name, 'act_date' => date('Y-m-d'), 'act_time' => time()]);
            return response(Vessel::updateOrCreate(['vessel_id' => $request->vessel_id], $request->all()));
        }
    }

    public function updateVesselOperator(Request $request)
    {
        if ($request->ajax()) {
            Audit::create(['user' => Auth::user()->username, 'activity' => 'Update vessel operator ' . $request->operator_name, 'act_date' => date('Y-m-d'), 'act_time' => time()]);
            return response(VesselOperator::updateOrCreate(['vessel_operator_id' => $request->vessel_operator_id], $request->all()));
        }
    }

    public function deleteVessel(Request $request)
    {
        if ($request->ajax()) {
            Audit::create(['user' => Auth::user()->username, 'activity' => 'Deleted Vessel ' . $request->vessel_name, 'act_date' => date('Y-m-d'), 'act_time' => time()]);
            Vessel::destroy($request->vessel_id);
        }
    }

    public function findVesselByName(Request $request)
    {
        $name = $request->vessel_name;
        $result = Vessel::where('vessel_name', 'like', '%' . $name . '%')->get();
        return response()->json($result);
    }

    public function getVesselDetail(Request $request)
    {
        return response()->json(Vessel::find($request->vessel_id));
    }

    public function getVesselsForClient(Request $request)
    {
        $id = $request->id;
        return Vessel::join('clients', 'clients.client_id', '=', 'vessels.vessel_owner')
            ->where('client_id', '=', $id)
            ->get();
    }
    public function getVoyageNumbersForVessel(Request $request)
    {
        $id = $request->id;
        return Vessel::where('vessel_id', '=', $id)
            ->select('voyage_number')
            ->get();
    }

}
