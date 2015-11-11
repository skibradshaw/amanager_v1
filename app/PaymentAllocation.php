<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentAllocation extends Model
{
    //
    protected $table = 'payment_allocation';
    protected $fillable = ['payment_id','amount','month','year'];
    
    public function payment()
    {
	    return $this->belongsTo('App\Payment','payment_id');
    }
}
