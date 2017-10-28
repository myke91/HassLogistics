<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TarrifType extends Model {

    protected $table = 'tarrif_type';
    protected $fillable = ['tarrif_type_name'];
    protected $primaryKey = 'tarrif_type_id';
    public $timestamps = false;

}