<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $fillable = ['vessel'];
    protected $primaryKey = 'tarrif_id';
    public $timestamps = false;
}
