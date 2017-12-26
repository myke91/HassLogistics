<?php

namespace HASSLOGISTICS;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

    protected $table = 'clients';
    protected $fillable = ['client_name',
        'client_office_desc',
        'client_head_office',
        'client_digital_address',
        'client_email',
        'client_currency',
        'client_number'];
    protected $primaryKey = 'client_id';
    public $timestamps = false;

}
