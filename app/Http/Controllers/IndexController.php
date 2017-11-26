<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;

class IndexController extends Controller
{
    public function getLogin()
    {
        return view('auth.login');
    }
    public function getAddUser()
    {
        $roles = Role::all();
        return view('auth.add_new_user',compact('roles'));
    }
    public function postUser(Request $request)
    {
        User::create($request->all());
        return back()->with(['success'=>'User '. $request->username .'created successfully']);
    }
}
