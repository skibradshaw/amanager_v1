<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaseDeposit extends Model
{
    //
    

    //Relationships
    public function lease()
    {
    	return $this->belongsTo('App\Lease');
    }
    public function payments()
    {
    	return $this->hasMany('App\Payment','lease_deposit_id');
    }
    
}
