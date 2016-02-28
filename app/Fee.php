<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    //
    protected $fillable = ['lease_id','item_name','note', 'due_date','month','year', 'amount'];
    protected $dates = ['due_date'];
   
    public function lease()
    {
	    return $this->belongsTo('App\Lease','lease_id');
    }
}
