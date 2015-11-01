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


Route::get('/', ['middleware' => 'auth',function () {
    //return Auth::user();
    
    return view('page_template',['title' => 'Hello World']);
}]);


Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');

//Tenant Routes
Route::get('/tenants/lookup',['middleware' => 'auth',function(){
	return view('tenants.search');
}]);
Route::get('/tenants/search',['as' => 'tenants.search', 'uses' => 'TenantController@search']);
Route::post('/tenants/add',['as' => 'tenants.add_to_lease', 'uses' => 'TenantController@addToLease']);


//Better URLs
Route::bind('apartments',function($value,$route){
	return App\Apartment::where('name',$value)->first();
});

Route::resource('apartments','ApartmentController');
Route::resource('tenants','TenantController');
Route::resource('apartments.lease','LeaseController');