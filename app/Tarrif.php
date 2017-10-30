<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarrif extends Model {

    protected $table = 'tarrif';
    protected $fillable = ['tarrif_name'];
    protected $primaryKey = 'tarrif_id';
    public $timestamps = false;

}
