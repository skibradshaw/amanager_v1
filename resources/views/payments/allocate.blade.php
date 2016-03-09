
  	 <h3>{{ $payment->payment_type }} Payment {{ $payment->paid_date->format('n/d/Y') }}: ${{ number_format($payment->amount,2) }} by {{ $payment->method }} {{ (!empty($payment->check_no)) ? " #" . $payment->check_no : "(no #)" }}</h3>	
	 {!! Form::open(['route' => ['apartments.lease.payments.allocate','name' => $lease->apartment->name, 'lease_id' => $lease->id, 'payment_id' => $payment->id], 'method' => 'post', 'id' => 'allocate']) !!}
	 	<div class="row collapse">
		 	@foreach($lease->details as $m)
		 		<div class="small-1 columns text-center left">
					{!! Form::label($m->detailName()) !!}
					{!! Form::text($m->detailName(),$payment->allocations()->firstOrNew(['month' => $m->month, 'year' => $m->year])->amount,['class' => 'month_allocation']) !!}			 		
		 		</div>
			@endforeach
		 	
	 	</div>
	 	<div class="row">
		 	<div class="small-6 left">
		 		<h4 class="small">Allocated: $<span id="total">{{ $payment->amount }}</span> (Difference: $<span id="difference">0</span>)</h4>
		 		<p>Allocation must equal the payment total</p>
		 	</div>	
	 	</div>
		<button type="submit" id='submit_button' class="radius button tiny" disabled>Save</button>
     {!! Form::close(['class' => 'close-reveal-modal']) !!} 	
	 <a class="close-reveal-modal" aria-label="Close">&#215;</a>

<script type="text/javascript">
$( document ).ready(function() {
 

	//Payment Allocation
	var $form = $('#allocate'),
	    $summands = $form.find('.month_allocation'),
	    $sumDisplay = $('#total');
	    $diffDisplay = $('#difference');
	
	$form.delegate('.month_allocation', 'keyup', function ()
	{
	   
	    var sum = 0;
	    var diff = 0;
	    $summands.each(function ()
	    {
	        var value = Number($(this).val());
	        if (!isNaN(value)) sum += value;
	    });
	    diff = sum-{{ $payment->amount }};
	    $diffDisplay.text(diff.toFixed(2));
		$sumDisplay.text(sum.toFixed(2));
		
		if (sum == {{ $payment->amount }})
		$('#submit_button').removeAttr('disabled');
		else
		$('#submit_button').attr('disabled','disabled');
	
	    
	});
});	
</script>