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
	
	protected $fillable = ['firstname','lastname','phone','email','license_state','license_plate'];

    public function getPhoneAttribute($value) 
    {
        return "(".substr($value, 0, 3).") ".substr($value, 3, 3)."-".substr($value,6);
    }
    public function setPhoneAttribute($value) 
    {
        $this->attributes['phone'] = preg_replace('/[^0-9]/i', '', trim($value));
    }
	
	public function leases()
	{
		return $this->belongsToMany('App\Tenant');
	}
    
}
