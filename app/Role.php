<?php

namespace HASSLOGISTICS;

Use Illuminate\Database\Eloquent\Model;

Class Role extends Model {

    protected $table = 'roles';
    protected $fillable = ['name'];
    protected $primaryKey = 'r_id';
    public $timestamps = false;

    public function users() {
        return $this->hasMany('HASSLOGISTICS\User', 'role_id', 'r_id');
    }



}
