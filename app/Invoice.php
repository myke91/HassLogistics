<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {

    protected $table = 'invoice';
    protected $fillable = [
        'vessel_id',
        'client_id',
        'invoice_no',
        'bill_item',
        'billable',
        'unit_price',
        'quantity',
        'actual_cost',
        'invoice_date',
        'vat',
        'invoice_status'];
    protected $primaryKey = 'invoice_id';
    public $timestamps = false;

}
