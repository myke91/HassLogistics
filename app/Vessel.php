<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Vessel extends Model {

    protected $table = 'vessels';
    protected $fillable = ['vessel_name',
        'vessel_callsign',
        'vessel_class',
        'vessel_operator_id',
        'vessel_type',
        'vessel_type',
        'vessel_flag',
        'vessel_owner',
        'vessel_loa',
        'vessel_grt',
        'arrival_date',
        'departure_date',
        'imo',
        'construction_year',
        'crew',
        'reg_year',
        'reg_place',
        'homeport',
        'tonnage_certificate',
        'mmsi',
        'isps_no',
        'ice_class',
        'dwt',
        'sbt',
        'air_draft',
        'll',
        'gt',
        'loa',
        'knots',
        'ftc',
        'nt',
        'beam',
        'cbm_tank',
        'rgt',
        'max_draft',
        'g_factor',
        'double_bottom',
        'double_skin',
        'bow_thrusters',
        'stern_thrusters',
        'annual_fee',
        'inactive'];
    protected $primaryKey = 'vessel_id';
    public $timestamps = false;

     private $rules = array(
        'vessel_name' => 'required',
        'vessel_callsign'  => 'required' ,
        'vessel_class' => 'required',
        'vessel_operator_id' => 'required',
        'vessel_type' => 'required',
        'vessel_type' => 'required',
        'vessel_flag' => 'required',
        'vessel_owner' => 'required',
        'vessel_loa' => 'required',
        'vessel_grt' => 'required',
        'arrival_date' => 'required|vsa_less_than_vsd:departure_date',
        'departure_date' => 'required',
        'imo' => 'required',
        'construction_year' => 'required',
        'crew' => 'required',
        'reg_year' => 'required',
        'reg_place' => 'required',
        'homeport' => 'required',
        'tonnage_certificate' => 'required',
        'mmsi' => 'required',
        'isps_no' => 'required|numeric',
        'ice_class' => 'required',
        'dwt' => 'required',
        'sbt' => 'required',
        'air_draft' => 'required',
        'll' => 'required',
        'gt' => 'required',
        'loa' => 'required',
        'knots' => 'required',
        'ftc' => 'required',
        'nt' => 'required',
        'beam' => 'required',
        'cbm_tank' => 'required',
        'rgt' => 'required',
        'max_draft' => 'required',
        'g_factor' => 'required',
        'double_bottom' => '',
        'double_skin' => '',
        'bow_thrusters' => '',
        'stern_thrusters' => '',
        'annual_fee' => '',
        'inactive' => ''
    );

    private $errors;

    public function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->errors();
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}
