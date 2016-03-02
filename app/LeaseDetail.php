<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaseDetail extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //
    /**
     * Returns a name for the month i format Dec 15
     * @return [type] [description]
     */
    public function detailName()
    {
    	$return = \Carbon\Carbon::parse('first day of ' . date("F", mktime(0, 0, 0, $this->month, 10)) . ' ' . $this->year);
    	$return = $return->format('M') . '-' . $return->format('Y');
    	return $return;

    }
    /**
     * Description: Returns the sum of payments for the given month and tenant
     * @param  $tenant_id int
     * @param  $month int
     * @param  $year int
     * @return decimal for currency
     */
    public function monthAllocation($tenant_id)
    {
	    $return = 0;
	    foreach($this->lease->payments()->where('payment_type','<>', 'Deposit')->where('tenant_id',$tenant_id)->get() as $payment) {
		    $return += $payment->allocations()->whereRaw('month = ' . $this->month)->whereRaw('year = ' . $this->year)->sum('amount');
		    //echo $payment->allocations()->whereRaw('month = ' . $month)->whereRaw('year = ' . $year)->sum('amount');
		    //echo $payment;
	    }
	    
	    return $return;	    
    }

    public function monthBalance()
    {
	 	$d_start = \Carbon\Carbon::parse('first day of ' . date("F", mktime(0, 0, 0, $this->month, 10)) . ' ' . $this->year);
	 	$d_end = \Carbon\Carbon::parse('last day of ' . date("F", mktime(0, 0, 0, $this->month, 10)) . ' ' . $this->year);

	 	$amount_due = ($this->monthly_rent + $this->monthly_pet_rent) + $this->lease->fees()->whereBetween('due_date', [$d_start,$d_end])->sum('amount');
	 	//$paid_to_date = $this->payments()->whereBetween('paid_date',[$d_start,$d_end])->sum('amount');
	 	$paid_to_date = 0;
	 	foreach ($this->lease->tenants as $t) {
	 		$paid_to_date += $this->monthAllocation($t->id);
	 	}
	 	$balance = $amount_due-$paid_to_date;
	 	return $balance;    	
    }

    public function lease()
    {
    	return $this->belongsTo('\App\Lease','lease_id');
    }
}
