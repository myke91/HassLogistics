<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
