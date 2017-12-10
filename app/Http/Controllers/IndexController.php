<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Role;

class IndexController extends Controller
{
    public function getLogin()
    {
        if(!session()->has('url.intended'))
        {
            session(['url.intended' => url()->previous()]);
        }
        return view('auth.login');
    }
    public function getAddUser()
    {
        $roles = Role::all();
        $users = User::join('roles','roles.r_id','=','users.role_id')->get();
        return view('auth.add_new_user',compact('roles','users'));
    }
    public function postUser(Request $request)
    {
        User::create($request->all());
        return back()->with(['success'=>'User '. $request->username .' created successfully']);
    }
    
    public function ready(Request $request){
        return response()->json(['message'=>'Service running ...'.date('d-M-Y H:i:s')]);
    }
    public function editUser(Request $request)
    {
        if($request->ajax())
        {
            return response(User::find($request->id));
        }
    }
    public function updateUser(Request $request)
    {
        if ($request->ajax()) {
            return response(User::updateOrCreate(['id' => $request->id], $request->all()));
        }
    }
}
