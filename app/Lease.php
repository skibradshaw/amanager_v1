<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    //
    
    protected $fillable = ['apartment_id','startdate','enddate','monthly_rent','pet_rent','deposit','pet_deposit'];
    
    public function apartment() {
	    return $this->belongsTo('App\Apartment','apartment_id');
    }
}
