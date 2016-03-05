<?php

namespace App\Http\Controllers;

//use Request;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Apartment;
use App\Property;

class ApartmentController extends Controller
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
    public function index(Property $property)
    {
        //
        $apartments = Apartment::with(['property' => function($q){$q->orderBy('name');}])->where('property_id',$property->id)->orderBy('number')->get();
        //$apartments = $apartments->property()->orderBy('properties.name')->get();
        return view('apartments.index',['title' => $property->name . ': Apartments','property' => $property,'apartments' => $apartments]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Property $property)
    {
        //
        $properties = Property::lists('abbreviation','id');
        
        return view('apartments.edit',['title' => 'Create Apartment: ' . $property->name,'property' => $property, 'properties' => $properties]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Property $property, Request $request)
    {
        //
        //return $request->property_id; 
        $this->validate($request,[
                'number' => 'required|unique:apartments,number,NULL,NULL,property_id,'.$request->input('property_id')        
            ]);

        //$input = Request::all();
        $input = $request->all();
        $input['name'] = $property->abbreviation . $input['number'];
        //return $input;
        Apartment::create($input);
        return redirect()->route('properties.apartments.index',['id' => $property->id]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        //
        return view('apartments.show',['title' => $apartment->property->name . " - " . $apartment->name, 'apartment' => $apartment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        //
        $properties = Property::lists('abbreviation','id');
        //$apartment = Apartment::with('property')->find($id);
        
        return view('apartments.edit',['title' => 'Edit Apartment','properties' => $properties, 'apartment' => $apartment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        //
        $input = $request->all();
        //$apartment = Apartment::find($id);
        $apartment->fill($input);
        $apartment->save();
        return back();
        
    }

}
