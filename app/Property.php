<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    
    public function apartments() {
	    return $this->hasMany('App\Apartment');
    }

    public function leases(){
    	return $this->hasManyThrough('App\Lease','App\Apartment');
    }

    public function deposits()
    {
    	return $this->hasMany('App\Deposit');
    }

    public function undeposited()
    {
    	// return $this->apartments->leases->payments->where('')
    	$undeposited = 0;
    	foreach($this->apartments as $a)
    	{
    		foreach($a->leases as $l)
    		{
    			$undeposited += $l->payments()->whereNull('bank_deposits_id')->get()->sum('amount');
    		}
    	}

    	return $undeposited;
    }
}
