<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',['as'=>'/','uses'=>'LoginController@getLogin']);
Route::post('/login',['as'=>'login','uses'=>'LoginController@postLogin']);

Route::get('/dashboard',['as'=>'dashboard','uses'=>'DashboardController@dashboard']);
Route::get('/logout',['as'=>'logout','uses'=>'LoginController@getLogout']);

Route::get('/add_vessel', ['as'=>'add_vessel','uses'=>'VesselController@addVessel']);


Route::get('/invoice',function(){
    return view('invoicing/invoice');
});
