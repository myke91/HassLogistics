<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempInvoice extends Model {

    protected $table = 'temp_invoice';
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
    public $timestamps = true;

}
