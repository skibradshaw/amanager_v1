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
        $tenants = Tenant::get();
        return view('tenants.index',['title' => 'Tenants','tenants' => $tenants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $input = Request::all();
        if(isset($input['lease_id']))
        {
	        $button = 'Create & Add Tenant';
	        $lease_id = $input['lease_id'];	        
        } else {
	        $button = 'Create Tenant';
	        $lease_id = 0;

        }
        return view('tenants.edit',['title' => 'Create New Tenant','button' => $button,'lease_id' => $lease_id]);
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
        $input['username'] = $input['email'];
        $tenant = Tenant::create($input);
        
        if(isset($input['lease_id']))
        {
	        $lease = Lease::find($input['lease_id']);
	        //$tenant->leases()->attach($lease);
	        $lease->tenants()->attach($tenant);
	        return redirect()->action('LeaseController@show', [$lease->apartment->name,$lease->id]);
        }
        
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
       $button = 'Update Tenant';
       return view('tenants.edit',['title' => 'Update Tenant: ' . $tenant->lastname,'tenant' => $tenant,'button' => $button]);
        
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
