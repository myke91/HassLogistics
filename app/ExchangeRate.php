<?php

namespace HASSLOGISTICS;

use Illuminate\Database\Eloquent\Model;
use Validator;

class ExchangeRate extends Model
{
    protected $table = 'exchange_rates';
    protected $fillable = ['currency', 'selling_price', 'buying_price'];
    protected $primaryKey = 'exchange_rate_id';
    public $timestamps = false;
    private $errors;
    private $rules = array(
        'currency' => 'required|unique:exchange_rates',
        'selling_price' => 'required',
        'buying_price' => 'required',
    );

    public function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails()) {
            // set errors and return false
            $this->errors = $v->errors();
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}
