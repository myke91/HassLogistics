<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TarrifCharge extends Model {

    protected $table = 'tarrif_charge';
    protected $fillable = ['billable','cost'];
    protected $primaryKey = 'tarrif_charge_id';
    public $timestamps = false;

}
