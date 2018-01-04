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
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/reset', ['as' => '', 'uses' => 'Auth\ResetPasswordController@reset']);
Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::get('/receipt', function () {
    return View::make('pdf.receipt');
});
Route::get('/noPermission', function () {
    return view('permission.noPermission');
});

Route::group(['middleware' => ['authen', 'roles'], 'roles' => ['admin']], function () {
    Route::get('/add_vessel', ['as' => 'add_vessel', 'uses' => 'VesselController@addVessel']);
    Route::get('/show/vesselinfo', ['as' => 'showVesselInfo', 'uses' => 'VesselController@showVesselInformation']);
    Route::get('/edit/vesselinfo', ['as' => 'editVessel', 'uses' => 'VesselController@editVessel']);
    Route::get('/add_client', ['as' => 'add_client', 'uses' => 'ClientController@addClient']);
    Route::get('/show/client', ['as' => 'showClientInfo', 'uses' => 'ClientController@showClientInformation']);
    Route::get('/edit/client', ['as' => 'editClient', 'uses' => 'ClientController@editClient']);
    Route::get('/vessel_operator', ['as' => 'add_vessel_operator', 'uses' => 'VesselController@addVesselOperator']);
    Route::get('/show/vessel_operators', ['as' => 'vessel_operators', 'uses' => 'VesselController@showVesselOperators']);
    Route::get('/edit/vessel_operator', ['as' => 'edit_vessel_operator', 'uses' => 'VesselController@editVesselOperator']);
    Route::get('/exchange_rate', ['as' => 'addExchangeRate', 'uses' => 'ExchangeRateController@addExchangeRate']);
    Route::get('/show/exchange_rate', ['as' => 'exchangeRate', 'uses' => 'ExchangeRateController@showExchangeRate']);
    Route::get('/edit/exchange_rate', ['as' => 'editExchangeRate', 'uses' => 'ExchangeRateController@editExchangeRate']);
    Route::get('/invoice', ['as' => 'invoice', 'uses' => 'InvoiceController@prepareInvoice']);
    Route::get('/invoice-history', ['as' => 'invoiceInfoPage', 'uses' => 'InvoiceController@getInvoiceInfo']);
    Route::get('/invoice/history', ['as' => 'showInvoiceInfo', 'uses' => 'InvoiceController@showInvoiceInfo']);
    Route::get('/invoice-modification', ['as' => 'invoiceModification', 'uses' => 'InvoiceController@getInvoiceModification']);
    Route::get('invoice-details', ['as' => 'getInvoiceDetails', 'uses' => 'InvoiceController@getInvoiceDetails']);
    Route::get('unapproved-invoices', ['as' => 'getUnapprovedInvoices', 'uses' => 'InvoiceController@getUnapprovedInvoices']);
    Route::get('/download-invoice', ['as' => 'downloadInvoiceFile', 'uses' => 'InvoiceController@downloadInvoiceFile']);
    Route::get('/download-reciept', ['as' => 'downloadRecieptFile', 'uses' => 'PaymentController@downloadReceiptFile']);
    Route::get('/pdf-invoice', ['as' => 'generateInvoiceFile', 'uses' => 'InvoiceController@generateInvoiceFile']);
    Route::get('/pdf-receipt', ['as' => 'generateRecieptFile', 'uses' => 'PaymentController@generateReceiptFile']);
    Route::get('show-payment', ['as' => 'getPayment', 'uses' => 'PaymentController@getPayment']);
    Route::get('/invoice-payment', ['as' => 'showPayment', 'uses' => 'PaymentController@showPayment']);
    Route::get('/add_new_user', ['as' => 'add_new_user', 'uses' => 'IndexController@getAddUser']);
    Route::get('/cashPayments', ['as' => 'cashPayments', 'uses' => 'PaymentController@getCashPayments']);
    Route::get('/chequesPayment', ['as' => 'chequePayments', 'uses' => 'PaymentController@getChequePayments']);
    Route::get('/accountPayments', ['as' => 'accountPayments', 'uses' => 'PaymentController@getAccountPayments']);
    Route::get('/paymentOnAccount', ['as' => 'paymentOnAccount', 'uses' => 'PaymentController@getPaymentOnAccount']);
    Route::get('/getVesselsForClient', ['as' => 'getVesselsForClient', 'uses' => 'VesselController@getVesselsForClient']);
    Route::get('/getVoyageNumbersForVessel', ['as' => 'getVoyageNumbersForVessel', 'uses' => 'VesselController@getVoyageNumbersForVessel']);
    Route::get('/editTempInvoice', ['as' => 'editTempInvoice', 'uses' => 'InvoiceController@editTempInvoice']);
    Route::get('/track-payments', ['as' => 'getTrackPayments', 'uses' => 'InvoiceController@getTrackPayments']);
    Route::get('/tarrif-form', ['as' => 'getTarrifForm', 'uses' => 'TarrifController@getTarrifForm']);
    Route::get('/tarrif-type-form', ['as' => 'getTarrifTypeForm', 'uses' => 'TarrifController@getTarrifTypeForm']);
    Route::get('/tarrif-params-form', ['as' => 'getTarrifParamForm', 'uses' => 'TarrifController@getTarrifParamForm']);
    Route::get('/tarrif-charge-form', ['as' => 'getTarrifChargeForm', 'uses' => 'TarrifController@getTarrifChargeForm']);
    Route::get('/edit-tarrif', ['as' => 'editTarrif', 'uses' => 'TarrifController@editTarrif']);
    Route::get('/edit-tarrifType', ['as' => 'editTarrifType', 'uses' => 'TarrifController@editTarrifType']);
    Route::get('/edit-tarrifParam', ['as' => 'editTarrifParam', 'uses' => 'TarrifController@editTarrifParam']);
    Route::get('/edit-tarrifCharge', ['as' => 'editTarrifCharge', 'uses' => 'TarrifController@editTarrifCharge']);
    Route::get('/edit-user', ['as' => 'editUser', 'uses' => 'IndexController@editUser']);
    Route::get('/process-payment-track', ['as' => 'processPaymentTrack', 'uses' => 'PaymentController@processPaymentTrack']);
    Route::get('/payment-summary', ['as' => 'paymentSummary', 'uses' => 'HomeController@paymentSummary']);
    Route::get('/details-for-top', ['as' => 'getDetailsForTopup', 'uses' => 'PaymentController@getDetailsForTopup']);
    Route::get('/account-summary',['as'=>'getAccountSummary','uses'=>'PaymentController@getAccountSummary']);
    Route::get('/transaction-history',['as'=>'getTransactionHistory','uses'=>'PaymentController@getTransactionHistory']);

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
    Route::post('/save-account-topup', ['as' => 'saveAccountTopup', 'uses' => 'PaymentController@saveAccountTopup']);
    Route::post('/post/exchange_rate', ['as' => 'createExchangeRate', 'uses' => 'ExchangeRateController@createExchangeRate']);
    Route::post('/update/exchange_rate', ['as' => 'updateExchangeRate', 'uses' => 'ExchangeRateController@updateExchangeRate']);
    Route::post('approve-invoice', ['as' => 'approveInvoice', 'uses' => 'InvoiceController@approveInvoice']);
    Route::post('/api/save-invoice', ['as' => 'saveInvoice', 'uses' => 'InvoiceController@saveInvoice']);
    Route::post('/create-tempinvoice', ['as' => 'createTempInvoice', 'uses' => 'InvoiceController@createTempInvoice']);
    Route::post('/save-payment', ['as' => 'savePayment', 'uses' => 'PaymentController@savePayment']);
    Route::post('/post-user', ['as' => 'postUser', 'uses' => 'IndexController@postUser']);
    Route::post('/confirm-invoice', ['as' => 'confirmInvoice', 'uses' => 'InvoiceController@confirmAndSaveInvoice']);
    Route::post('/confirm-all-invoice', ['as' => 'saveAllAndGenerateInvoice', 'uses' => 'InvoiceController@saveAllAndGenerateInvoice']);
    Route::post('/save-payment-from-Invoice', ['as' => 'paymentFromInvoice', 'uses' => 'PaymentController@savePaymentFromInvoice']);
    Route::post('/confirm-all-invoice', ['as' => 'saveAllAndGenerateInvoice', 'uses' => 'InvoiceController@saveAllAndGenerateInvoice']);
    Route::post('/clear-temp-table', ['as' => 'clearTempInvoiceTable', 'uses' => 'InvoiceController@clearTempInvoiceTable']);
    Route::post('/delete-invoice', ['as' => 'deleteInvoce', 'uses' => 'InvoiceController@deleteTempInvoice']);
    Route::post('/updateTempInvoice', ['as' => 'updateTempInvoice', 'uses' => 'InvoiceController@updateTempInvoice']);
    Route::post('/save-tarrif', ['as' => 'saveTarrif', 'uses' => 'TarrifController@saveTarrif']);
    Route::post('/save-tarrif-type', ['as' => 'saveTarrifType', 'uses' => 'TarrifController@saveTarrifType']);
    Route::post('/save-tarrif-param', ['as' => 'saveTarrifParam', 'uses' => 'TarrifController@saveTarrifParam']);
    Route::post('/save-tarrif-charge', ['as' => 'saveTarrifCharge', 'uses' => 'TarrifController@saveTarrifCharge']);

    Route::post('/init-account', ['as' => 'initAccount', 'uses' => 'PaymentController@initAccount']);
    Route::post('/update-tarrif', ['as' => 'updateTarrif', 'uses' => 'TarrifController@updateTarrif']);
    Route::post('/update-tarrifType', ['as' => 'updateTarrifType', 'uses' => 'TarrifController@updateTarrifType']);
    Route::post('/update-tarrifParam', ['as' => 'updateTarrifParam', 'uses' => 'TarrifController@updateTarrifParam']);
    Route::post('/update-tarrifCharge', ['as' => 'updateTarrifCharge', 'uses' => 'TarrifController@updateTarrifCharge']);

    Route::post('/update-user', ['as' => 'updateUser', 'uses' => 'IndexController@updateUser']);
    Route::post('/save-account-topup', ['as' => 'saveAccountTopup', 'uses' => 'PaymentController@saveAccountTopup']);

// api urls
    Route::get('/api/tarrifs', ['as' => 'getTarrifs', 'uses' => 'InvoiceController@getTarrifs']);
    Route::get('/api/tarrif-types', ['as' => 'getTarrifTypes', 'uses' => 'InvoiceController@getTarrifTypes']);
    Route::get('/api/tarrif-params', ['as' => 'getTarrifParams', 'uses' => 'InvoiceController@getTarrifParams']);
    Route::get('/api/tarrif-charges', ['as' => 'getTarrifCharges', 'uses' => 'InvoiceController@getTarrifCharges']);
    Route::get('/api/bill-charge', ['as' => 'getBillCharge', 'uses' => 'InvoiceController@getBillCharge']);
    Route::get('/api/vessel-search', ['as' => 'findVesselByName', 'uses' => 'VesselController@findVesselByName']);
    Route::get('/api/vessel-detail', ['as' => 'getVesselDetail', 'uses' => 'VesselController@getVesselDetail']);
});

Route::group(['middleware' => ['authen', 'roles'], 'roles' => ['clerk']], function () {

});

Route::group(['middleware' => ['authen', 'roles'], 'roles' => ['manager']], function () {

});

Route::group(['middleware' => ['authen', 'roles'], 'roles' => ['cashier']], function () {

});
Route::group(['middleware' => ['authen', 'roles'], 'roles' => ['front desk']], function () {

});
