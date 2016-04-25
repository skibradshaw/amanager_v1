<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Lease;
use App\Tenanat;
use App\Apartment;
use App\Property;

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
    public function rentsDue(Property $property)
    {
        $current_leases = $property->leases()->where('enddate', '>=', Carbon::now())->get();
        return view('reports.rentsdue', ['title' => $property->name . " Rents Due", 'property' => $property, 'current_leases' => $current_leases]);
    }
    //
    
    public function depositsDue(Property $property)
    {
        $current_leases = $property->leases()->where('enddate', '>=', Carbon::now())->get();
        return view('reports.depositsdue', ['title' => $property->name . " Deposits Due", 'property' => $property, 'current_leases' => $current_leases]);
    }
}
