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

    public function showTerminate(Apartment $apartment, Lease $lease)
    {
        return view('leases.terminate',['title' => $lease->apartment->name . ' Lease: ' . $lease->startdate->format('n/j/Y') . ' - ' . $lease->enddate->format('n/j/Y'),'lease' => $lease]);
    }

    public function terminate(Apartment $apartment, Lease $lease, Request $request)
    {
        $input = $request->all();
        //Set the End Date
        $lease->enddate = Carbon::parse($input['enddate']);
        $lease->save();
        
        foreach($lease->details as $detail)
        {
            $detail_first_day = Carbon::parse('first day of ' . date("F", mktime(0, 0, 0, $detail->month, 10)) . ' ' . $detail->year);
            $detail_last_day = Carbon::parse('last day of ' . date("F", mktime(0, 0, 0, $detail->month, 10)) . ' ' . $detail->year);
            // echo $detail_last_day . ": ";
            if($detail_last_day >= Carbon::parse('first day of ' . date("F", mktime(0, 0, 0, $lease->enddate->month, 10)) . " " . $lease->enddate->year))
            {
                if($detail_last_day <= Carbon::parse('last day of '. date("F", mktime(0, 0, 0, $lease->enddate->month, 10)) . " " . $lease->enddate->year))
                {
                    //Modify Mulitiplier on Last Month
                    $multiplier = round(($lease->enddate->day)/date('t',strtotime($lease->enddate->format('Y-m-d'))),2);
                    // echo "Modify Multiplier: " . $multiplier . "<br>";
                    $detail->multiplier = $multiplier;
                    $detail->save();
                } else {
                    //Delete Future Lease Details
                    // echo "Delete Future Details<br>";
                    $detail->delete();
                }
            }

        }
        
        return redirect('/')->with('status','Lease Deleted!');
                    
    }
}
