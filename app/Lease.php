<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lease extends Model
{
    //
    
    protected $fillable = ['apartment_id','startdate','enddate','monthly_rent','pet_rent','deposit','pet_deposit'];
    protected $dates = ['startdate','enddate'];
    
    //Relationships
    public function apartment() {
	    return $this->belongsTo('App\Apartment');
    }
    
    public function details()
    {
    	return $this->hasMany('App\LeaseDetail');
    }
    
    public function leaseDeposits()
    {
        return $this->hasMany('App\LeaseDeposit');
    }

    public function tenants() {
	    return $this->belongsToMany('App\Tenant')->withPivot('sublessor_name')->withTimestamps();
    }

    public function fees()
    {
	    return $this->hasMany('App\Fee','lease_id');
    }
    
    public function payments()
    {
	    return $this->hasMany('App\Payment','lease_id');
    }

    public function allocations()
    {
        return $this->hasManyThrough('App\PaymentAllocation','App\Payment');
    }
    
    public function getTotalfeesAttribute()
    {
	    return $this->fees->sum('amount');
    }

    
    /**
     * Returns the number of completed months as a percentage of all months on a lease.
     * @return decimal % of lease complete
     */
    public function progress()
    {
    	$return = 0;
    	$complete = $this->startdate->diffInDays(Carbon::now());
    	$total = $this->enddate->diffInDays($this->startdate);
    	return $complete/$total;
    }
    /**
     * Description: Open Balance is calculated by going through each month up through and including the current month and adding up the amount due.
     * @return decimal for currency
     */
    public function openBalance($tenant_id = null)
    {
    	$balance = 0;
    	foreach($this->details as $m)
    	{
    		$lease_mo = Carbon::parse('first day of ' . date("F", mktime(0, 0, 0, $m->month, 10)) . ' ' . $m->year);
    		$current_mo = Carbon::parse('last day of ' . Carbon::now());
    		if($lease_mo->lt($current_mo))
    		{
	    		$balance += $m->monthBalance();   			
    		}
    	}
    	return $balance;

    }

    public function depositBalance()
    {
        $deposit_amount = $this->leaseDeposits()->sum('amount');
        $deposit_payments = $this->payments()->where('payment_type','Deposit')->sum('amount');
        $deposit_balance = $deposit_amount - $deposit_payments;
        return $deposit_balance;


    }

    /**
     * Description: Returns the length of the lease in months with fraction of month.
     * @return decimal
     * 
     */
    public function getLengthAttribute()
    {
			$a = strtotime($this->startdate);
			$b = strtotime($this->enddate);
		
			$month1 = date("n", $a);
			$month2 = date("n", $b);
			
			$year1 = date("Y", $a); 
			$year2 = date("Y", $b);
			
			$total_year = $year2 - $year1;
			$total_year = $total_year * 12;
		
			$total_month = (($month2 - $month1) + $total_year) - 1;
		
			# fraction of start month
			$month1 = date("n", $a);
			$year1 =date("Y", $a);
			$day1 =  date("j", $a);
		
			$num_days1 = cal_days_in_month(CAL_GREGORIAN, $month1, $year1);
			$frac1 = number_format(($num_days1-($day1-1))/$num_days1, 2, '.', '');
		
			# fraction of end month
			$month2 = date("n", $b);
			$year2 =date("Y", $b);
			$day2 =  date("j", $b);
		
			$num_days2 = cal_days_in_month(CAL_GREGORIAN, $month2, $year2);
			$frac2 = number_format($day2/$num_days2, 2, '.', '');
			
			return $total_month + $frac1 + $frac2;
	    
    }
    
    public function monthFees($month,$year)
    {
    	return $this->fees()->whereRaw('MONTH(due_date) = ' . $month)->whereRaw('YEAR(due_date) = ' . $year)->sum('amount');
    }

    
}
