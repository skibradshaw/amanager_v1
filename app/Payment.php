<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = ['lease_id','tenant_id','method','memo','paid_date','amount','check_no'];
    
    protected $dates = ['paid_date'];
    
    public function lease()
    {
	    return $this->belongsTo('App\Lease','lease_id');
    }
    
}
