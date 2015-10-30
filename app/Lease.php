<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model
{
    //
    
    protected $fillable = ['apartment_id','startdate','enddate','monthly_rent','pet_rent','deposit','pet_deposit'];
    protected $dates = ['startdate','enddate'];
    
    public function apartment() {
	    return $this->belongsTo('App\Apartment');
    }
}
