<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller
{
    protected function guard()
    {
        return Auth::guard('secure');
    }
    public function getLogin()
    {
        return view('login');
    }
    public function postLogin(Request $request)
    {

        if (Auth::attempt(['username'=>$request->username,
            'password'=>$request->password,'active'=> 1]))
        {
            return redirect()->intended('dashboard');

        }
        return redirect()->back()->with(['error' =>'Wrong Credentials']);


    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('/');
    }
}
