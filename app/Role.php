<?php

namespace App;

Use Illuminate\Database\Eloquent\Model;

Class Role extends Model {

    protected $table = 'roles';
    protected $fillable = ['name'];
    protected $primaryKey = 'role_id';
    public $timestamps = false;

    public function users() {
        return $this->hasMany('App\User', 'id', 'role_id');
    }



}
