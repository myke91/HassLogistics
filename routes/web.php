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
Route::post('/add_vessel_operator',['as'=>'postVesseOperator','uses'=>'VesselController@createVesselOperator']);
Route::post('/post_vessel',['as'=>'postCreateVessel','uses'=>'VesselController@createVessel']);
Route::get('/show/vesselinfo',['as'=>'showVesselInfo','uses'=>'VesselController@showVesselInformation']);
Route::get('/edit/vesselinfo',['as'=>'editVessel','uses'=>'VesselController@editVessel']);
Route::post('/update/vesselinfo',['as'=>'updateVessel','uses'=>'VesselController@updateVessel']);
Route::post('/delete/vesselinfo',['as'=>'deleteVessel','uses'=>'VesselController@deleteVessel']);

Route::get('/add_client', ['as'=>'add_client','uses'=>'ClientController@addClient']);
Route::post('/post/client',['as'=>'postCreateClient','uses'=>'ClientController@createClient']);
Route::get('/show/client',['as'=>'showClientInfo','uses'=>'ClientController@showClientInformation']);
Route::get('/edit/client',['as'=>'editClient','uses'=>'ClientController@editClient']);
Route::post('/update/client',['as'=>'updateClient','uses'=>'ClientController@updateClient']);
Route::post('/delete/client',['as'=>'deleteClient','uses'=>'ClientController@deleteClient']);
