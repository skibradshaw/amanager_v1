<h3>{{ $tenant->fullname }}: {{ $leasemonth->format('M') . " " . $leasemonth->format('Y') }} Payments</h3>
	
	@foreach($tenant->payments()->where('lease_id',$lease->id)->where('payment_type','<>','Deposit')->whereRaw('MONTH(paid_date) = ' . $leasemonth->month)->whereRaw('YEAR(paid_date) = '. $leasemonth->year)->get() as $payment)
		<div class="row">
			<div class="small-12 columns">
				<a href="{{ route('apartments.lease.payments.allocate',['name' => $lease->apartment->name, 'lease_id' => $lease->id, 'payment_id' => $payment->id]) }}?leasemonth={{ $payment->paid_date->format('m').'-'.$payment->paid_date->format('Y') }}" data-reveal-id="allocatePayment" data-reveal-ajax="true">{{ $payment->paid_date->format('M') . ' ' . $payment->paid_date->format('Y') }}: ${{ number_format($payment->amount,2) }} {{ $payment->method }} {{ (!empty($payment->check_no)) ? " #" . $payment->check_no : "(no #)" }} </a><br>
				@foreach($payment->allocations as $a)
					{{ " $" . number_format($a->amount,2)}}	allocated to {{$a->name }} for {{ $payment->payment_type }} <br>
				@endforeach
			</div>
		</div>
	@endforeach