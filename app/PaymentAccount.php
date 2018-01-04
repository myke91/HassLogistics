<?php

namespace HASSLOGISTICS;

use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{   
    protected $table = 'payment_account';
    protected $fillable = [
    'client_id',
    'client',
    'account_balance'
    ];
    protected $primaryKey = 'payment_account_id';
    public $timestamps = true;
}
