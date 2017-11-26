<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class VesselOperator extends Model {

    protected $table = 'vessel_operators';
    protected $fillable = ['operator_name'];
    protected $primaryKey = 'vessel_operator_id';
    public $timestamps = false;
    private $errors;
    private $rules = array(
        'operator_name' => 'required',
    );

    public function validate($data) {
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

    public function errors() {
        return $this->errors;
    }

}
