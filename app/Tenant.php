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
    
}
