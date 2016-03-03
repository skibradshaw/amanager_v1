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
}
