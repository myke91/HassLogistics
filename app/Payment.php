<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'vessel_id',
        'client_id',
        'bill_item',
        'payment_mode',
        'actual_cost',
        'amount_paid',
        'balance',
        'discount',
        'description',
        'remark',
        'payment_date',
        'user_id'];
    protected $primaryKey = 'payment_id';
    public $timestamps = false;
}
