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
		 	$return[] = [
		 		'Month' => $d->format('n'),
		 		'Year' => $d->format('Y'),
		 		'Multiplier' => $multiplier
		 	];
		 	
		}	    
	    
	    return $return;
    }
}
