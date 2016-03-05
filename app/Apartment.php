<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    //
    protected $fillable = ['name','number','property_id','active'];
    
    public function property() {
	    return $this->belongsTo('App\Property','property_id');
    }
    
    public function leases() {
	    return $this->hasMany('App\Lease','apartment_id')->orderBy('startdate','DESC');
    }

    public function currentLease() {
    	$lease = $this->leases()->whereRaw('DATE(NOW()) BETWEEN startdate AND enddate')->first();
    	(empty($lease)) ? $lease = $this->leases()->whereRaw('DATE(NOW()) <= startdate')->first() : null;
    	return $lease;
    }


	public function checkAvailability($start,$end)
	{
		// \DB::connection()->enableQueryLog();
		$return = false;
		$start = \Carbon\Carbon::parse($start);
		$end = \Carbon\Carbon::parse($end);
		$leases = \App\Lease::where('apartment_id',$this->id)->where(function($q) use ($start,$end) {
						$q->whereRaw('"' . $start . '" <= enddate');
						$q->whereRaw('"' . $end . '" >= startdate');
					})
					->get();
		
		($leases->count() == 0) ? $return = true : $return = false;
		return $return;
		
	}
}
