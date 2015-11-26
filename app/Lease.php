<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lease extends Model
{
    //
    
    protected $fillable = ['apartment_id','startdate','enddate','monthly_rent','pet_rent','deposit','pet_deposit'];
    protected $dates = ['startdate','enddate'];
    
    public function apartment() {
	    return $this->belongsTo('App\Apartment');
    }
    
    public function tenants() {
	    return $this->belongsToMany('App\Tenant');
    }
    
    public function fees()
    {
	    return $this->hasMany('App\Fee','lease_id');
    }
    
    public function payments()
    {
	    return $this->hasMany('App\Payment','lease_id');
    }
    
    public function getTotalfeesAttribute()
    {
	    return $this->fees->sum('amount');
    }
    
    /**
     * Description: Open Balance is calculated by going through each month up through and including the current month and adding up the amount due.
     * @return decimal for currency
     */
    public function openBalance()
    {
    	$balance = 0;
    	foreach($this->leaseMos() as $m)
    	{
    		$lease_mo = Carbon::parse('first day of '.$m['Name']);
    		$current_mo = Carbon::parse('last day of ' . Carbon::now());
    		if($lease_mo->lt($current_mo))
    		{
	    		$balance += $m['Balance'];   			
    		}
    	}
    	return $balance;

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
    
    /**
     * Description: Returns the sum of payments for the given month and tenant
     * @param  $tenant_id int
     * @param  $month int
     * @param  $year int
     * @return decimal for currency
     */
    public function monthAllocation($tenant_id, $month, $year)
    {
	    $return = 0;
	    foreach($this->payments()->where('tenant_id',$tenant_id)->get() as $payment) {
		    $return += $payment->allocations()->whereRaw('month = ' . $month)->whereRaw('year = ' . $year)->sum('amount');
		    //echo $payment->allocations()->whereRaw('month = ' . $month)->whereRaw('year = ' . $year)->sum('amount');
		    //echo $payment;
	    }
	    
	    return $return;
	    
	    
    }
    /**
     * Description: Returns an array for all the months on a lease that includes
     * Month, Year, Friendly Name, Multiplier for Fractional Months, Number of Payments,
     * Total Amount Due for the Month, Remaining Balance.  
     * @todo : This still needs to have an fees assessed that month calculated into the balance.
     * @return array
     */
    public function leaseMos()
    {
	    $return = [];
	    $start = $this->startdate;
	    $end = $this->enddate;

		$inc = \DateInterval::createFromDateString('first day of next month');
		$p = new \DatePeriod($this->startdate,$inc,$this->enddate);
		
		foreach($p as $d){
			$d = Carbon::instance($d);
			$d_start = Carbon::parse('first day of '.$d->format('M').' '.$d->format('Y'));
			$d_end = Carbon::parse('last day of '.$d->format('M').' '.$d->format('Y'));			

			//If the startdate has the same month and year as the current month, calculate a partial
			if($start->month == $d->format('n') && $start->year == $d->format('Y')) {
				$multiplier = round((date('t',strtotime($d->format('Y-m-d')))-($start->day-1))/date('t',strtotime($d->format('Y-m-d'))),2);
			
			}
			//Else If the enddate has the same month and year as this month, calculate for partial			
			elseif($end->month == $d->format('n') && $end->year == $d->format('Y')) {
				$multiplier = round(($end->day)/date('t',strtotime($d->format('Y-m-d'))),2);
			}
			//else calculate a full month
		 	else {
			 	//echo '- Full Month';
			 	$multiplier = 1.0;
		 	}
		 	$amount_due = ($this->monthly_rent + $this->pet_rent)*$multiplier + $this->fees()->whereBetween('due_date', [$d_start,$d_end])->sum('amount');
		 	$paid_to_date = $this->payments()->whereBetween('paid_date',[$d_start,$d_end])->sum('amount');
		 	$num_payments = $this->payments()->whereBetween('paid_date',[$d_start,$d_end])->count('id');
		 	$balance = $amount_due-$paid_to_date;
		 	
		 	$return[] = [
		 		'Month' => $d->format('n'),
		 		'Year' => $d->format('Y'),
		 		'Name' => $d->format('M'). '-' . $d->format('Y'),
		 		'Multiplier' => $multiplier,
		 		'Payments' => $num_payments,
		 		'Due' => $amount_due,
		 		'Balance' => $balance
		 	];
		 	
		 	
		}	    
	    $return = collect($return);
	    return $return;
    }
    
}
