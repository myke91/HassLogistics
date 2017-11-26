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

Route::get('/', ['as' => '/', 'uses' => 'IndexController@getLogin']);
Route::get('/ready', ['as' => 'ready', 'uses' => 'IndexController@ready']);
Route::group(['middleware' => 'authen'], function () {
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/add_vessel', ['as' => 'add_vessel', 'uses' => 'VesselController@addVessel']);


    Route::get('/show/vesselinfo', ['as' => 'showVesselInfo', 'uses' => 'VesselController@showVesselInformation']);
    Route::get('/edit/vesselinfo', ['as' => 'editVessel', 'uses' => 'VesselController@editVessel']);
    Route::get('/add_client', ['as' => 'add_client', 'uses' => 'ClientController@addClient']);
    Route::get('/show/client', ['as' => 'showClientInfo', 'uses' => 'ClientController@showClientInformation']);
    Route::get('/edit/client', ['as' => 'editClient', 'uses' => 'ClientController@editClient']);
    Route::get('/vessel_operator', ['as' => 'add_vessel_operator', 'uses' => 'VesselController@addVesselOperator']);
    Route::get('/show/vessel_operators', ['as' => 'vessel_operators', 'uses' => 'VesselController@showVesselOperators']);
    Route::get('/edit/vessel_operator', ['as' => 'edit_vessel_operator', 'uses' => 'VesselController@editVesselOperator']);
    Route::get('/invoice', ['as' => 'invoice', 'uses' => 'InvoiceController@prepareInvoice']);
    Route::get('/invoice-history', ['as' => 'invoiceInfoPage', 'uses' => 'InvoiceController@getInvoiceInfo']);
    Route::get('/invoice/history', ['as' => 'showInvoiceInfo', 'uses' => 'InvoiceController@showInvoiceInfo']);
    Route::get('/invoice-modification', ['as' => 'invoiceModification', 'uses' => 'InvoiceController@getInvoiceModification']);
    Route::get('/invoice/pdf', ['as' => 'generateInvoicePdfStream', 'uses' => 'InvoiceController@generateInvoicePdfStream']);
    Route::get('show-payment', ['as' => 'getPayment', 'uses' => 'PaymentController@getPayment']);
    Route::get('/invoice-payment', ['as' => 'showPayment', 'uses' => 'PaymentController@showPayment']);
    Route::get('/add_new_user', ['as' => 'add_new_user', 'uses' => 'IndexController@getAddUser']);
    Route::get('/cashPayments', ['as' => 'cashPayments', 'uses' => 'PaymentController@getCashPayments']);
    Route::get('/chequesPayment', ['as' => 'chequePayments', 'uses' => 'PaymentController@getChequePayments']);
    Route::get('/paymentOnAccount', ['as' => 'paymentOnAccount', 'uses' => 'PaymentController@getPaymentOnAccount']);


// post urls
    Route::post('/add_vessel_operator', ['as' => 'postVesselOperator', 'uses' => 'VesselController@createVesselOperator']);
    Route::post('/post_vessel', ['as' => 'postCreateVessel', 'uses' => 'VesselController@createVessel']);
    Route::post('/update/vesselinfo', ['as' => 'updateVessel', 'uses' => 'VesselController@updateVessel']);
    Route::post('/delete/vesselinfo', ['as' => 'deleteVessel', 'uses' => 'VesselController@deleteVessel']);
    Route::post('/post/client', ['as' => 'createClient', 'uses' => 'ClientController@createClient']);
    Route::post('/update/client', ['as' => 'updateClient', 'uses' => 'ClientController@updateClient']);
    Route::post('/delete/client', ['as' => 'deleteClient', 'uses' => 'ClientController@deleteClient']);
    Route::post('/post/vessel_operator', ['as' => 'createVesselOperator', 'uses' => 'VesselController@createVesselOperator']);
    Route::post('/update/vessel_operator', ['as' => 'updateVesselOperator', 'uses' => 'VesselController@updateVesselOperator']);
    Route::post('/delete/vessel_operator', ['as' => 'deleteOperator', 'uses' => 'VesselController@deleteVesselOperator']);
    Route::post('/api/save-invoice', ['as' => 'saveInvoice', 'uses' => 'InvoiceController@saveInvoice']);
    Route::post('/api/create-invoice', ['as' => 'createInvoice', 'uses' => 'InvoiceController@createInvoice']);
    Route::post('/save-payment', ['as' => 'savePayment', 'uses' => 'PaymentController@savePayment']);
    Route::post('/post-user', ['as' => 'postUser', 'uses' => 'IndexController@postUser']);

// api urls
    Route::get('/api/tarrifs', ['as' => 'getTarrifs', 'uses' => 'InvoiceController@getTarrifs']);
    Route::get('/api/tarrif-types', ['as' => 'getTarrifTypes', 'uses' => 'InvoiceController@getTarrifTypes']);
    Route::get('/api/tarrif-params', ['as' => 'getTarrifParams', 'uses' => 'InvoiceController@getTarrifParams']);
    Route::get('/api/tarrif-charges', ['as' => 'getTarrifCharges', 'uses' => 'InvoiceController@getTarrifCharges']);
    Route::get('/api/bill-charge', ['as' => 'getBillCharge', 'uses' => 'InvoiceController@getBillCharge']);
    Route::get('/api/vessel-search', ['as' => 'findVesselByName', 'uses' => 'VesselController@findVesselByName']);
    Route::get('/api/vessel-detail', ['as' => 'getVesselDetail', 'uses' => 'VesselController@getVesselDetail']);
});
Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/reset', ['as' => '', 'uses' => 'Auth\ResetPasswordController@reset']);
Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);


