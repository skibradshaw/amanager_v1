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

    /**
     * Calculates the Total Undeposited Funds for the Property
     * @return [type] [description]
     */
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

    public function tenants()
    {
        $tenants = 0;
        foreach($this->leases as $l)
        {
            $tenants += $l->tenants()->count('users.id');
        }
        return $tenants;
    }

    public function rentBalance()
    {
        $rentbalance = 0;
        foreach($this->leases as $l)
        {
            $rentbalance += $l->openBalance();
        }
        return $rentbalance;
    }

    public function depositBalance()
    {
        $depositbalance = 0;
        foreach ($this->leases as $l) {
            $depositbalance += $l->depositBalance();
        }
        return $depositbalance;
    }
}
