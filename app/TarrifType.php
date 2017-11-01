<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TarrifType extends Model {

    protected $table = 'tarrif_type';
    protected $fillable = ['tarrif_type_name','tarrif_type_code'];
    protected $primaryKey = 'tarrif_type_id';
    public $timestamps = false;

    public function tarrif() {
        return $this->belongsTo('App\Tarrif', 'tarrif_id', 'tarrif_id');
    }
    
    public function params() {
        return $this->hasMany('App\TarrifParams', 'tarrif_type_id', 'tarrif_type_id');
    }

}
