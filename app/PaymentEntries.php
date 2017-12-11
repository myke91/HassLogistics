<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentEntries extends Model {

    protected $table = 'payment_entries';
    protected $fillable = [
        'vessel_id',
        'client_id',
        'user',
        'username',
        'payment_mode',
        'actual_cost',
        'amount_paid',
        'balance',
        'invoice_no',
        'discount',
        'description',
        'remark',
        'payment_date',
        'account_name',
        'account_number',
        'cheque_date',
        'total_cost',
        ];
    protected $primaryKey = 'payment_entries_id';
    public $timestamps = true;

}
