<?php

namespace HASSLOGISTICS;

use Illuminate\Database\Eloquent\Model;

class InvoiceHeader extends Model
{
    protected $table = 'invoice_header';
    protected $fillable = [
        'vessel',
        'client',
        'vessel_id',
        'client_id',
        'voyage_number',
        'invoice_file_name',
        'invoice_currency',
        'invoice_no',
        'invoice_date',
        'invoice_status',
        'due_date',
        'username',
        'user',
        'total_amount'
    ];
    protected $primaryKey = 'invoice_header_id';
    public $timestamps = false;
}
