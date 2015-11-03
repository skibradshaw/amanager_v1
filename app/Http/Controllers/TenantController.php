<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Tenant;
use App\Lease;
use DB;


class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tenants = Tenant::get();
        return view('tenants.index',['title' => 'Tenants','tenants' => $tenants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tenants.edit',['title' => 'Create New Tenant']);
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
        $input = Request::all();
        $input['type'] = 'tenant';
        $tenant = Tenant::create($input);
        
        return redirect('tenants');
        
        
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
    public function edit(Tenant $tenant)
    {
        //
       //$tenant = Tenant::find($id);
       return view('tenants.edit',['title' => 'Update Tenant: ' . $tenant->lastname,'tenant' => $tenant]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tenant $tenant)
    {
        //
        $input = Request::all();
        //$tenant = Tenant::find($id);
        $tenant->fill($input);
        $tenant->save();
        return back();
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
    
    public function search(Request $request)
    {
		$term = Request::get('term');
		
		$results = array();
		
		$queries = DB::table('users')
			->where('firstname', 'LIKE', '%'.$term.'%')
			->orWhere('lastname', 'LIKE', '%'.$term.'%')
			->get();
		
		foreach ($queries as $query)
		{
		    $results[] = [ 'id' => $query->id, 'value' => $query->firstname.' '.$query->lastname ];
		}

		return response()->json($results);	    
    }
    
    public function addToLease(Request $request)
    {
	    $input = Request::all();
	    $lease = Lease::find($input['lease_id']);
	    if(!$lease->tenants->contains($input['tenant_id']))
	    {
		    $lease->tenants()->attach($input['tenant_id']);		    
	    }
	    
	    return redirect()->route('apartments.lease.show',['name' => $lease->apartment->name, 'id' => $lease->id]);
    }
}
