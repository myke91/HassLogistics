<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TarrifParams extends Model {

    protected $table = 'tarrif_params';
    protected $fillable = ['tarrif_param_name',
        'tarrif_param_code',
        'tarrif_param_charge_type',
        'tarrif_param_remarks','tarrif_type_id'];
    protected $primaryKey = 'tarrif_param_id';
    public $timestamps = false;

    public function type() {
        return $this->belongsTo('App\TarrifType', 'tarrif_type_id', 'tarrif_type_id');
    }
    
    public function charges(){
        return $this->hasMany('App\TarrifCharge', 'tarrif_param_id', 'tarrif_param_id');
    }
}
