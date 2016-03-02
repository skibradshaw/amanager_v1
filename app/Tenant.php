<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\TenantScope;

class Tenant extends User
{
    //

	public static function boot()
	{
		parent::boot();		
		static::addGlobalScope(new TenantScope);
	}
	
	protected $fillable = ['firstname','lastname','phone','email','license_state','license_plate','type','username'];

    public function getFullNameAttribute()
    {
	    return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }

    public function setFirstnameAttribute($value)
    {
    	$this->attributes['firstname'] = ucfirst($value);
    }
 
     public function setLastnameAttribute($value)
    {
    	$this->attributes['lastname'] = ucfirst($value);
    }

    public function getPhoneAttribute($value) 
    {
        return "(".substr($value, 0, 3).") ".substr($value, 3, 3)."-".substr($value,6);
    }
    public function setPhoneAttribute($value) 
    {
        $this->attributes['phone'] = preg_replace('/[^0-9]/i', '', trim($value));
    }
    public function currentLease() {
    	$lease = $this->leases()->whereRaw('DATE(NOW()) BETWEEN startdate AND enddate')->first();
    	(empty($lease)) ? $lease = $this->leases()->whereRaw('DATE(NOW()) <= startdate')->first() : null;
    	return $lease;
    }	

	public function leases()
	{
		return $this->belongsToMany('App\Lease')->withPivot('sublessor_name')->withTimestamps();
	}
	
	public function payments()
	{
		return $this->hasMany('App\Payment','tenant_id');
	}
    
}
