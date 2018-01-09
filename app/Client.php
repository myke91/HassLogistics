<?php

namespace HASSLOGISTICS;

use Illuminate\Database\Eloquent\Model;
use \Validator;

class Client extends Model
{

    protected $table = 'clients';
    protected $fillable = ['client_name',
        'client_office_desc',
        'client_head_office',
        'client_digital_address',
        'client_email',
        'client_currency',
        'client_number'];
    protected $primaryKey = 'client_id';
    public $timestamps = true;

    private $rules = array(
        'client_name' => 'required|unique:clients',
        'client_office_desc' => 'required',
        'client_head_office' => 'required',
        'client_digital_address' => 'required',
        'client_email' => 'email',
        'client_currency' => 'required',
        'client_number' => 'required',
    );

    private $errors;

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
