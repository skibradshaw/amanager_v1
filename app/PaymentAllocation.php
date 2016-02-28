<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentAllocation extends Model
{
    //
    protected $table = 'payment_allocation';
    protected $fillable = ['payment_id','amount','month','year'];

    public function getNameAttribute()
    {
    	$return = \Carbon\Carbon::parse('first day of ' . date("F", mktime(0, 0, 0, $this->month, 10)) . ' ' . $this->year);
    	$return = $return->format('M') . '-' . $return->format('Y');
    	return $return;

    }    
    public function payment()
    {
	    return $this->belongsTo('App\Payment','payment_id');
    }
}
