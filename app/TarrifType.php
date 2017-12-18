<?php

namespace HASSLOGISTICS;

use Illuminate\Database\Eloquent\Model;

class TarrifType extends Model {

    protected $table = 'tarrif_type';
    protected $fillable = ['tarrif_type_name','tarrif_type_code','tarrif_id'];
    protected $primaryKey = 'tarrif_type_id';
    public $timestamps = false;

    public function tarrif() {
        return $this->belongsTo('HASSLOGISTICS\Tarrif', 'tarrif_id', 'tarrif_id');
    }
    
    public function params() {
        return $this->hasMany('HASSLOGISTICS\TarrifParams', 'tarrif_type_id', 'tarrif_type_id');
    }

}
