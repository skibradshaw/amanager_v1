<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

Use App\Tenant;
use App\Lease;
use App\Apartment;
Use App\Fee;

class FeeController extends Controller
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
    public function index(Apartment $apartment, Lease $lease)
    {
        //
        $fees = $lease->fees;
        return view('fees.index',['title' => 'All Fees For: ' . $lease->apartment->name . ' Lease: ' . $lease->startdate->format('n/j/y') . ' - ' . $lease->enddate->format('n/j/y'),'fees' => $fees,'apartment' => $apartment, 'lease' => $lease]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Apartment $apartment, Lease $lease, Request $request)
    {
        //
        $fees = ['Miscellaneous' => 'Miscellaneous', 'Late Fee' => 'Late Fee', 'Damage Fee' => 'Damage Fee'];
        
        return view('fees.edit',['title' => 'Assess Fee: ' . $lease->apartment->name . ' Lease: ' . $lease->startdate->format('n/j/y') . ' - ' . $lease->enddate->format('n/j/y'), 'lease' => $lease, 'fees' => $fees]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Apartment $apartment, Lease $lease, Request $request)
    {
        //
        $input = $request->all();
        $input['due_date'] = Carbon::parse($input['due_date']);
        $input['lease_id'] = $lease->id;
        $input['month'] = Carbon::parse($input['due_date'])->month;
        $input['year'] = Carbon::parse($input['due_date'])->year;
        $due_date = $input['due_date'];
        if($due_date->lt($lease->startdate) || $due_date->gt($lease->enddate))
        {
            return redirect()->back()->with('status','Fee Due Date Must be within Lease Dates ('.$lease->startdate->format('n/d/Y'). '-' . $lease->enddate->format('n/d/Y').')')->withInput();
        }
        $fee = Fee::create($input);
        return redirect()->route('apartments.lease.show',['name' => $lease->apartment->name,'id' => $lease->id])->with('status', 'Fee Added Successfully!');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment, Lease $lease, Fee $fee)
    {
        //
        $fees = ['Miscellaneous' => 'Miscellaneous', 'Late Fee' => 'Late Fee', 'Damage Fee' => 'Damage Fee'];
        // return $id;
        
        return view('fees.edit',['title' => 'Edit Fee: ' . $lease->apartment->name . ' Lease: ' . $lease->startdate->format('n/j/y') . ' - ' . $lease->enddate->format('n/j/y'), 'lease' => $lease,'fee' => $fee, 'fees' => $fees]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Apartment $apartment, Lease $lease, Fee $fee, Request $request)
    {
        //
        $fee->update($request->except('due_date'));
        $fee->due_date = Carbon::parse($request->input('due_date'));
        $fee->save();
        return redirect()->route('apartments.lease.show',['name' => $lease->apartment->name,'lease' => $lease->id]);
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
