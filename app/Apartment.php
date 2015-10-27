<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    //
    protected $fillable = ['name','number','properties_id','active'];
    
    public function property() {
	    return $this->belongsTo('App\Property','properties_id');
    }
    
    public function leases() {
	    return $this->hasMany('App\Lease','apartment_id');
    }
}
