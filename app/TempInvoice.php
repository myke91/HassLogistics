<?php

namespace HASSLOGISTICS;

use Illuminate\Database\Eloquent\Model;

class TempInvoice extends Model {

    protected $table = 'temp_invoice';
    protected $fillable = [
        'vessel_id',
        'client_id',
        'invoice_no',
        'bill_item',
        'billable',
        'unit_price',
        'quantity',
        'actual_cost',
        'vat',
        'invoice_date',
        'invoice_status'];
    protected $primaryKey = 'invoice_id';
    public $timestamps = true;

}
