<?php

namespace HASSLOGISTICS;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model {

    protected $table = 'audit';
    protected $fillable = ['user',
        'activity',
        'act_date',
        'act_time'];
    protected $primaryKey = 'audit_id';
    public $timestamps = true;

}
