<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TarrifParams extends Model {

    protected $table = 'tarrif_params';
    protected $fillable = ['tarrif_param_name',
        'tarrif_param_charge_type',
        'tarrif_param_remarks'];
    protected $primaryKey = 'client_id';
    public $timestamps = false;

}
