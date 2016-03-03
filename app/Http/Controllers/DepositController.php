<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Payment;
use App\Deposit;
use App\Property;
use Carbon\Carbon;

class DepositController extends Controller
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
        $deposits = Deposit::orderBy('deposit_date','desc')->get();
        return view('deposits.index',['title' => 'Deposit History','deposits' => $deposits]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        $input = $request->except(['payment_id']);
        $payments = $request->only(['payment_id']);
        $input['deposit_date'] = Carbon::parse($input['deposit_date']);
        $input['user_id'] = \Auth::user()->id;
        //Bank Transaction ID is currently a placeholder for a future need/feature
        $deposit = Deposit::create($input);
        foreach($payments['payment_id'] as $p)
        {
            Payment::where('id',$p)->update(['bank_deposits_id' => $deposit->id]);   
        }

        return redirect()->route('deposits.index');

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

    public function confirm(Request $request)
    {
        $input = $request->all();
        
        $total = $input['deposit_total'];
        $ids = '';
        foreach($input as $key => $value)
        {
            //echo strpos($key,'_');
            if(substr($key, 0,strpos($key,'_')) == 'paymentid')
            {
                //echo substr($key, strpos($key,'_')+1,strlen($key));
                $ids .= substr($key, strpos($key,'_')+1,strlen($key)) . ',';
            }
        }
        $ids = rtrim($ids,',');
        $payments = Payment::whereRaw('id IN ('.$ids.')')->get();
        //return $payments;
        return view('deposits.confirm_deposit',['title' => 'Confirm Bank Deposit','payments' => $payments,'total' => $total]);
    }


    public function undeposited(Request $request)
    {
	    $propertyid = $request->input('propertyid');
        // return $propertyid;
        (isset($propertyid)) ? $property = Property::find($propertyid) : $property = null;
        if(isset($propertyid))
        {
            $rentpayments = Payment::where('payment_type','<>','Deposit')
                    ->whereRaw('bank_deposits_id IS NULL')
                    ->whereHas('lease',function($q) use ($propertyid){
                        $q->join('apartments',function($join) use ($propertyid){
                            $join->on('apartments.id','=','leases.apartment_id')
                                ->where('property_id','=',$propertyid);
                        });
                    })->get();
            $depositpayments = Payment::where('payment_type','=','Deposit')
                    ->whereRaw('bank_deposits_id IS NULL')
                    ->whereHas('lease',function($q) use ($propertyid){
                        $q->join('apartments',function($join) use ($propertyid){
                            $join->on('apartments.id','=','leases.apartment_id')
                                ->where('property_id','=',$propertyid);
                        });
                    })->get();
        } else {
            $rentpayments = Payment::where('payment_type','<>','Deposit')->whereRaw('bank_deposits_id IS NULL')->get();
            $depositpayments = Payment::where('payment_type','=','Deposit')->whereRaw('bank_deposits_id IS NULL')->get();            
        }
        $properties = Property::all();
        $title = 'Undeposited Funds'; 
        (!is_null($property)) ? $title = $title . ": " . $property->name : $title;


	    return view('deposits.undeposited_funds',['title' => $title,'properties' => $properties, 'rentpayments' => $rentpayments, 'depositpayments' => $depositpayments]);
    }
}
