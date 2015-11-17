<?php

namespace App\Http\Controllers;

use Request;
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
    public function index()
    {
        //
        $apartments = Apartment::with('property')->get();
        return view('apartments.index',['title' => 'Apartments','apartments' => $apartments]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $properties = Property::lists('abbreviation','id');
        
        return view('apartments.edit',['title' => 'Create Apartment','properties' => $properties]);
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
        //return $input;
        Apartment::create($input);
        return redirect('apartments');
        
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
        $input = Request::all();
        //$apartment = Apartment::find($id);
        $apartment->fill($input);
        $apartment->save();
        return back();
        
    }

}
