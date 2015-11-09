<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Tenant;
use App\Lease;
use App\Apartment;
use App\Payment;

class PaymentController extends Controller
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
    public function create(Apartment $apartment, Lease $lease, Request $request)
    {
        //
        
        $tenants = $lease->tenants->lists('fullname','id');
        (Request::input('tenant_id')) ? $tenant = Tenant::find(Request::input('tenant_id')) : $tenant = new Tenant;
        //return $tenant;
        return view('payments.edit',['title' => 'Record a Payment: ' . $lease->apartment->name . ' Lease: ' . $lease->startdate->format('n/j/y') . ' - ' . $lease->enddate->format('n/j/y')  ,'apartment' => $apartment, 'lease' => $lease, 'tenants' => $tenants, 'tenant' => $tenant]);
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
        $input = Request::all();
        $input['paid_date'] = Carbon::parse($input['paid_date']);
        Payment::create($input);
        return redirect()->route('apartments.lease.show',['name' => $lease->apartment->name,'id' => $lease->id]);
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
    
	public function showAllocate(Apartment $apartment, Lease $lease, Payment $payment)
	{
		return view('payments.allocate',['lease' => $lease, 'payment' => $payment]);
	}
	
    public function allocate(Apartment $apartment, Lease $lease, Payment $payment, Request $request)
    {
	    return $lease;
    }
}
