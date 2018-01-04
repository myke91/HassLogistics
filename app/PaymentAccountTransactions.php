<?php

namespace HASSLOGISTICS;

use Illuminate\Database\Eloquent\Model;

class PaymentAccountTransactions extends Model
{
    protected $table = 'payment_account_transactions';
    protected $fillable = [
        'client_id',
        'client',
        'credit',
        'debit',
        'transaction_type',
        'transaction_date',
        'remarks'
    ];
    protected $primaryKey = 'transaction_id';
    public $timestamps = true;
}
