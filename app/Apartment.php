<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    //
    protected $fillable = ['name'];
    
    public function property() {
	    return $this->belongsTo('App\Property');
    }
}
