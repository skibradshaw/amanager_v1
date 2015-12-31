<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Route Model Mapping
Route::model('apartments','App\Apartment');
Route::model('tenants','App\Tenant');
Route::model('lease', 'App\Lease');
Route::model('payments','App\Payment');
Route::model('fees','App\Fee');


Route::get('/','HomeController@index');


Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

//Deposit Routes
Route::get('/deposits/undeposited',['as' => 'undeposited','uses' => 'DepositController@undeposited']);
Route::post('/deposits/confirm',['as' => 'deposit.confirm','uses' => 'DepositController@confirm']);

//Tenant Routes
Route::get('/tenants/lookup',['middleware' => 'auth',function(){
	return view('tenants.search');
}]);
Route::get('/tenants/search',['as' => 'tenants.search', 'uses' => 'TenantController@search']);
Route::post('/tenants/add',['as' => 'tenants.add_to_lease', 'uses' => 'TenantController@addToLease']);

//Payment Routes
Route::get('/apartments/{apartments}/lease/{lease}/payments/{payments}/allocate',['as' => 'apartments.lease.payments.allocate', 'uses' => 'PaymentController@showAllocate']);
Route::post('/apartments/{apartments}/lease/{lease}/payments/{payments}/allocate',['as' => 'apartments.lease.payments.allocate', 'uses' => 'PaymentController@allocate']);
Route::get('/apartments/{apartments}/lease/{lease}/payments/choose',['as' => 'apartments.lease.payments.choose', 'uses' => 'PaymentController@choose']);

//Lease Routes
Route::get('/apartments/{apartments}/lease/{lease}/pet_rent',['as' => 'apartments.lease.petrent', 'uses' => 'LeaseDetailController@showPetRent']);
Route::post('/apartments/{apartments}/lease/{lease}/pet_rent',['as' => 'apartments.lease.petrent', 'uses' => 'LeaseDetailController@storePetRent']);
Route::post('/apartments/{apartments}/lease/{lease}/single_pet_rent',['as' => 'apartments.lease.singlepetrent', 'uses' => 'LeaseDetailController@storeSinglePetRent']);

//Reports
Route::get('/reports/rents_due',['as' => 'reports.rentsdue', 'uses' => 'ReportController@rentsDue']);
Route::get('/reports/deposits_due',['as' => 'reports.depositsdue', 'uses' => 'ReportController@depositsDue']);

//Better URLs
Route::bind('apartments',function($value,$route){
	return App\Apartment::where('name',$value)->first();
});

Route::resource('apartments','ApartmentController');
Route::resource('tenants','TenantController');
Route::resource('apartments.lease','LeaseController');
Route::resource('apartments.lease.payments','PaymentController');
Route::resource('apartments.lease.fees', 'FeeController');
Route::resource('deposits','DepositController');