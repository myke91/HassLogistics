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
        'vessel_LOA',
        'vessel_GRT',
        'arrival_date',
        'departure_date'];
    protected $primaryKey = 'vessel_id';
    public $timestamps = false;

}
