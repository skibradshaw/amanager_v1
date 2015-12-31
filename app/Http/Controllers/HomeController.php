<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Apartment;
use App\Tenant;
use App\Lease;
use Carbon\Carbon;

class HomeController extends Controller
{
	public function __construct()
    {
	    $this->middleware('auth');
    } 

    //
    public function index()
    {
	    $current_leases = Lease::where('enddate','>=',\Carbon\Carbon::now())->get();
	    $current_balance = 0;
	    $deposit_balance = 0;
	    foreach ($current_leases as $lease) {
	    	$current_balance += $lease->openBalance();
	    	$deposit_balance += $lease->depositBalance();
	    }

	    $tenants = Tenant::all()->count();
	    $apartments = Apartment::all()->count();
	    return view('index',[
	    	'title' => 'Happy ' . \Carbon\Carbon::now()->format('l'), 
	    	'current_leases' => $current_leases,
	    	'current_balance' => $current_balance,
	    	'deposit_balance' => $deposit_balance,
	        'tenants' => $tenants,
	        'apartments' => $apartments
	    	]);   	
    }
}
