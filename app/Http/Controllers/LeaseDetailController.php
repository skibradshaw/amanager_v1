<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Apartment;
use App\Lease;
use App\LeaseDetail;

class LeaseDetailController extends Controller
{
    public function showPetRent(Apartment $apartment, Lease $lease)
    {
        return view('leases.petrent', ['apartment' => $apartment,'lease' => $lease]);
    }

    public function storePetRent(Apartment $apartment, Lease $lease, Request $request)
    {
        $input = $request->all();
        foreach ($input as $key => $value) {
            if ($key != '_token' && $key != 'monthly_pet_rent') {
                //echo $key . ": " . $value . "<br>";
                $detail = LeaseDetail::find($key);
                $detail->monthly_pet_rent = $value;
                $detail->save();

            }
        }
        return back();
    }

    public function storeSinglePetRent(Apartment $apartment, Lease $lease, Request $request)
    {
        $detail = LeaseDetail::find($request->id);
        $detail->monthly_pet_rent = $request->value;
        $detail->save();
        return number_format($detail->monthly_pet_rent, 2);
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
    public function create()
    {
        //
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
}
