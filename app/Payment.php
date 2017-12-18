<?php

namespace HASSLOGISTICS;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'vessel_id',
        'client_id',
        'user',
        'username',
        'invoice_no',
        'payment_mode',
        'actual_cost',
        'amount_paid',
        'balance',
        'discount',
        'description',
        'remark',
        'payment_date',
        'account_name',
        'account_number',
        'cheque_date',
        'total_cost',
        ];
    protected $primaryKey = 'payment_id';
    public $timestamps = true;
}
