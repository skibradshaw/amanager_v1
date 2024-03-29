<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Tenant;
use App\Lease;
use App\Apartment;
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
        $tenants = Tenant::orderBy('lastname','asc')->get();
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
        $input = $request->all();
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
        $this->validate($request,[
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email|unique:users,email',
                'phone' => 'phone:US'
            ]);

        $input = $request->all();
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
    public function show(Tenant $tenant)
    {
        //
        return view('tenants.show',['title' => $tenant->fullname,'tenant' => $tenant]);

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
        // return $request->all();
        $input = $request->all();
        //$tenant = Tenant::find($id);¬
        $tenant->fill($input);
        $tenant->save();
        return redirect((!empty($request->input('redirect'))) ? $request->input('redirect') : redirect('tenants'));
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
		$term = $request->get('term');
		
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
	    $input = $request->all();
	    $lease = Lease::find($input['lease_id']);
	    if(!$lease->tenants->contains($input['tenant_id']))
	    {
		    $lease->tenants()->attach($input['tenant_id']);		    
	    }
	    
	    return redirect()->route('apartments.lease.show',['name' => $lease->apartment->name, 'id' => $lease->id]);
    }

    public function showSublease(Apartment $apartment, Lease $lease, $tenant_id)
    {
        $tenant = Tenant::find($tenant_id);
        $sublessor_name = $lease->tenants()->where('tenant_id',$tenant->id)->first()->pivot->sublessor_name;
        return view('tenants.sublease',['lease' => $lease, 'tenant' => $tenant, 'sublessor_name' => $sublessor_name]);
    }

    public function addSublease(Request $request)
    {
        $input = $request->all();
        $tenant = Tenant::find($input['tenant_id']);
        $lease = Lease::find($input['lease_id']);
        // lease->tenants()->where('tenant_id',$tenant->id)->sync([$tenant->id => ['sublessor_name' => $input['sublessor_name']]]);
        $lease_tenant = $lease->tenants()->where('tenant_id',$tenant->id)->first();
        $lease_tenant->pivot->sublessor_name = $input['sublessor_name'];
        $lease_tenant->pivot->save();
        return redirect()->route('apartments.lease.show',['name' => $lease->apartment->name, 'id' => $lease->id]);
    }
}
