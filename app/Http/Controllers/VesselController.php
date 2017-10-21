<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VesselController extends Controller
{
    public function addVessel()
    {
        return view('data.vessel.new_vessel');
    }
}
