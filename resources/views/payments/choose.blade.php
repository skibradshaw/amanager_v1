<h3>Choose Payment to Allocate ({{ $tenant->fullname . ' ' . $title }})</h3>
	
	@foreach($tenant->payments()->where('lease_id',$lease->id)->get() as $payment)
		<div class="row">
			<div class="small-12 columns">
				<a href="{{ route('apartments.lease.payments.allocate',['name' => $lease->apartment->name, 'lease_id' => $lease->id, 'payment_id' => $payment->id]) }}" data-reveal-id="allocatePayment" data-reveal-ajax="true">{{ $payment->paid_date->format('M') . ' ' . $payment->paid_date->format('Y') }} - ${{ number_format($payment->amount,2) }}</a>
			</div>
		</div>
	@endforeach