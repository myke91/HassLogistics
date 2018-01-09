<?php

namespace HASSLOGISTICS;

use Illuminate\Database\Eloquent\Model;
use Validator;

class VesselOperator extends Model
{

    protected $table = 'vessel_operators';
    protected $fillable = ['operator_name'];
    protected $primaryKey = 'vessel_operator_id';
    public $timestamps = false;
    private $errors;

    private $rules = array(
        'operator_name' => 'required|unique:vessel_operators',
    );

    public function validate($data)
    {
        $v = Validator::make($data, $this->rules);

        if ($v->fails()) {
            $this->errors = $v->errors();
            return false;
        }
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

}
