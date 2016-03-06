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
Route::model('properties','App\Property');



Route::get('/','HomeController@index');


Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

//Deposit Routes
Route::get('/properties/{properties}/deposits/undeposited',['as' => 'undeposited','uses' => 'DepositController@undeposited']);
Route::post('/properties/{properties}/deposits/confirm',['as' => 'deposit.confirm','uses' => 'DepositController@confirm']);

//Tenant Routes
Route::get('/tenants/lookup',['middleware' => 'auth',function(){
	$tenants = App\Tenant::all();
    return view('tenants.search',['tenants' => $tenants]);
}]);
Route::get('/tenants/search',['as' => 'tenants.search', 'uses' => 'TenantController@search']);
Route::post('/tenants/add',['as' => 'tenants.add_to_lease', 'uses' => 'TenantController@addToLease']);
Route::post('/tenants/add_sublease',['as' => 'tenants.add_sublease','uses' => 'TenantController@addSublease']);
Route::get('/apartments/{apartments}/lease/{lease}/tenants/{tenant_id}','TenantController@showSublease');

//Payment Routes
Route::get('/apartments/{apartments}/lease/{lease}/payments/{payments}/allocate',['as' => 'apartments.lease.payments.allocate', 'uses' => 'PaymentController@showAllocate']);
Route::post('/apartments/{apartments}/lease/{lease}/payments/{payments}/allocate',['as' => 'apartments.lease.payments.allocate', 'uses' => 'PaymentController@allocate']);
Route::get('/apartments/{apartments}/lease/{lease}/payments/choose',['as' => 'apartments.lease.payments.choose', 'uses' => 'PaymentController@choose']);
Route::get('/apartments/{apartments}/lease/{lease}/{payments}/delete',['as' => 'apartments.lease.payments.delete', 'uses' => 'PaymentController@destroy']);

//Lease Routes
Route::get('/apartments/{apartments}/lease/{lease}/pet_rent',['as' => 'apartments.lease.petrent', 'uses' => 'LeaseDetailController@showPetRent']);
Route::post('/apartments/{apartments}/lease/{lease}/pet_rent',['as' => 'apartments.lease.petrent', 'uses' => 'LeaseDetailController@storePetRent']);
Route::post('/apartments/{apartments}/lease/{lease}/single_pet_rent',['as' => 'apartments.lease.singlepetrent', 'uses' => 'LeaseDetailController@storeSinglePetRent']);
Route::get('/apartments/{apartments}/lease/{lease}/terminate',['as' => 'apartments.lease.terminate','uses' => 'LeaseController@showTerminate']);
Route::post('/apartments/{apartments}/lease/{lease}/terminate',['as' => 'apartments.lease.terminate','uses' => 'LeaseController@terminate']);

//Fees Routes
Route::get('/apartments/{apartments}/lease/{lease}/{fees}/delete',['as' => 'apartments.lease.fees.delete', 'uses' => 'FeeController@destroy']);

//Reports
Route::get('/reports/{properties}/rents_due',['as' => 'reports.rentsdue', 'uses' => 'ReportController@rentsDue']);
Route::get('/reports/{properties}/deposits_due',['as' => 'reports.depositsdue', 'uses' => 'ReportController@depositsDue']);

//Better URLs
Route::bind('apartments',function($value,$route){
	return App\Apartment::where('name',$value)->first();
});

Route::resource('properties.apartments','ApartmentController');
Route::resource('tenants','TenantController');
Route::resource('apartments.lease','LeaseController');
Route::resource('apartments.lease.payments','PaymentController');
Route::resource('apartments.lease.fees', 'FeeController');
Route::resource('properties','PropertyController');
Route::resource('properties.deposits','DepositController');