<?php

namespace HASSLOGISTICS;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $table = 'invoice_details';
    protected $fillable = [
        'header_id',
        'bill_item',
        'billable',
        'unit_price',
        'quantity',
        'actual_cost',
    ];
    protected $primaryKey = 'invoice_details_id';
    public $timestamps = false;
}
