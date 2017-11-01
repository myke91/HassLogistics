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

//get urls
Route::get('/', ['as' => '/', 'uses' => 'LoginController@getLogin']);
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@dashboard']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@getLogout']);
Route::get('/add_vessel', ['as' => 'add_vessel', 'uses' => 'VesselController@addVessel']);
Route::get('/show/vesselinfo', ['as' => 'showVesselInfo', 'uses' => 'VesselController@showVesselInformation']);
Route::get('/edit/vesselinfo', ['as' => 'editVessel', 'uses' => 'VesselController@editVessel']);
Route::get('/add_client', ['as' => 'add_client', 'uses' => 'ClientController@addClient']);
Route::get('/show/client', ['as' => 'showClientInfo', 'uses' => 'ClientController@showClientInformation']);
Route::get('/edit/client', ['as' => 'editClient', 'uses' => 'ClientController@editClient']);
Route::get('/invoice', ['as' => 'invoice', 'uses' => 'InvoiceController@prepareInvoice']);

// post urls
Route::post('/add_vessel_operator', ['as' => 'postVesseOperator', 'uses' => 'VesselController@createVesselOperator']);
Route::post('/post_vessel', ['as' => 'postCreateVessel', 'uses' => 'VesselController@createVessel']);
Route::post('/update/vesselinfo', ['as' => 'updateVessel', 'uses' => 'VesselController@updateVessel']);
Route::post('/delete/vesselinfo', ['as' => 'deleteVessel', 'uses' => 'VesselController@deleteVessel']);
Route::post('/login', ['as' => 'login', 'uses' => 'LoginController@postLogin']);
Route::post('/post/client', ['as' => 'createClient', 'uses' => 'ClientController@createClient']);
Route::post('/update/client', ['as' => 'updateClient', 'uses' => 'ClientController@updateClient']);
Route::post('/delete/client', ['as' => 'deleteClient', 'uses' => 'ClientController@deleteClient']);

// api urls
Route::get('/api/tarrifs', ['as' => 'getTarrifs', 'uses' => 'InvoiceController@getTarrifs']);
Route::get('/api/tarrif-types', ['as' => 'getTarrifTypes', 'uses' => 'InvoiceController@getTarrifTypes']);
Route::get('/api/tarrif-params', ['as' => 'getTarrifParams', 'uses' => 'InvoiceController@getTarrifParams']);
Route::get('/api/tarrif-charges', ['as' => 'getTarrifCharges', 'uses' => 'InvoiceController@getTarrifCharges']);
Route::get('/api/bill-charge', ['as' => 'getBillCharge', 'uses' => 'InvoiceController@getBillCharge']);
