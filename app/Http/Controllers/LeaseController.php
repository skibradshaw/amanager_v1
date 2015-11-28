<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Apartment;
use App\Lease;
use Carbon\Carbon;

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
        $lease = Lease::create($input);
        $apartment = Apartment::find($lease->apartment_id);
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
        return view('leases.show',['title' => $title, 'lease' => $lease]);
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
