<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TarrifCharge extends Model {

    protected $table = 'tarrif_charge';
    protected $fillable = ['billable','cost','tarrif_param_id'];
    protected $primaryKey = 'tarrif_charge_id';
    public $timestamps = false;

    public function param()
    {
        return $this->belongsTo('App\TarrifCharge', 'tarrif_param_id', 'tarrif_param_id');
    }
}
