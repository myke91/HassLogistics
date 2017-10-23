<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VesselOperator extends Model
{
    protected $table = 'vessel_operators';
    protected $fillable = ['operator_name'];
    protected $primaryKey = 'vessel_operator_id';
    public $timestamps = false;
}
