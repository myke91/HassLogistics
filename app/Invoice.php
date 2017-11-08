<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $fillable = [
        'vessel_id',
        'client_id',
        'bill_item',
        'unit_price',
        'quantity',
        'actual_cost',
        'vat',
        'invoice_status'];
    protected $primaryKey = 'invoice_id';
    public $timestamps = false;
}
