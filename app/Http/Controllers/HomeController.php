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
	    $properties = \App\Property::all();
	    return view('index',[
	    	'title' => 'Happy ' . \Carbon\Carbon::now()->format('l'), 
	    	'properties' => $properties,
	    	]);   	
    }
}
