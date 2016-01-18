<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Apartment;
use App\Lease;
use App\Tenant;
use App\LeaseDetail;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class LeaseController extends Controller
{

	public function __construct()
    {
	    $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Apartment $apartment)
    {
        //
        return view('leases.edit',['title' => 'Create a New Lease: Apartment ' . $apartment->name, 'apartment' => $apartment ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
                'startdate' => 'required|date',
                'enddate' => 'required|date',
                'monthly_rent' => 'required|numeric',
                'pet_rent' => 'numeric',
                'deposit' => 'numeric',
                'pet_deposit' => 'numeric'
            ]);

        $input = $request->all();
        $input['startdate'] = Carbon::parse($input['startdate']);
        $input['enddate'] = Carbon::parse($input['enddate']);
        $apartment = Apartment::find($input['apartment_id']);

        // Check for Date overlap on existing leases
        if(!$apartment->checkAvailability($input['startdate'],$input['enddate']))
        {
            return back()->withInput()->with('error', 'These dates are not available!');
        }        
        $lease = Lease::create($input);
        //Create Lease Details
        $start = $lease->startdate;
        $end = $lease->enddate;
        $p = new \DatePeriod($start,CarbonInterval::months(1),$end);
        foreach($p as $d)
        {
            $d = Carbon::instance($d);
            $lease_detail = new LeaseDetail;
            $lease_detail->month = $d->format('n');
            $lease_detail->year = $d->format('Y');
            //If the startdate has the same month and year as the current month, calculate a partial
            if($start->month == $d->format('n') && $start->year == $d->format('Y')) {
                $multiplier = round((date('t',strtotime($d->format('Y-m-d')))-($start->day-1))/date('t',strtotime($d->format('Y-m-d'))),2);
            
            }
            //Else If the enddate has the same month and year as this month, calculate for partial          
            elseif($end->month == $d->format('n') && $end->year == $d->format('Y')) {
                $multiplier = round(($end->day)/date('t',strtotime($d->format('Y-m-d'))),2);
            }
            //else calculate a full month
            else {
                //echo '- Full Month';
                $multiplier = 1.0;
            }
            $lease_detail->multiplier = $multiplier;
            $lease_detail->monthly_rent = ($lease->monthly_rent*$multiplier);
            $lease_detail->monthly_pet_rent = ($lease->pet_rent*$multiplier);

            $lease->details()->save($lease_detail);



        }


        
        return redirect()->action('LeaseController@show', [$apartment->name,$lease->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment, Lease $lease)
    {
        //
        $title = $lease->apartment->property->name . ' ' . $lease->apartment->name . ' Lease: ' . $lease->startdate->format('n/j/Y') . ' - ' . $lease->enddate->format('n/j/Y');
        $tenants = Tenant::all();
        return view('leases.show',['title' => $title, 'lease' => $lease, 'tenants' => $tenants]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
	
}
