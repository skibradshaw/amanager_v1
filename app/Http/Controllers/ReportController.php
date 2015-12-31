<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Lease;
use App\Tenanat;
use App\Apartment;


class ReportController extends Controller
{
	public function __construct()
    {
	    $this->middleware('auth');
    }
    /**
     * Shows all Leases with an Open Balance
     * @return [type] [description]
     */
    public function rentsDue()
    {
    	$current_leases = Lease::where('enddate','>=',Carbon::now())->get();
    	return view('reports.rentsdue',['title' => "Rents Due",'current_leases' => $current_leases]);
    }
    //
    
    public function depositsDue()
    {
    	$current_leases = Lease::where('enddate','>=',Carbon::now())->get();
    	return view('reports.depositsdue',['title' => "Deposits Due", 'current_leases' => $current_leases]);
    }
}
