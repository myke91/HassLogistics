<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vat extends Model
{
    protected $table = 'vat';
    protected $fillable = ['value'];
    protected $primaryKey = 'id';
    public $timestamps = false;
}
