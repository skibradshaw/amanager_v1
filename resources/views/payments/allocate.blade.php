
  	 <h3>Total Payment:  ${{ $payment->amount }}</h3>	
	 {!! Form::open(['route' => ['apartments.lease.payments.allocate','name' => $lease->apartment->name, 'lease_id' => $lease->id, 'payment_id' => $payment->id], 'method' => 'post', 'id' => 'allocate']) !!}
	 	<div class="row collapse">
		 	@foreach($lease->leaseMos() as $m)
		 		<div class="small-1 columns text-center">
					{!! Form::label($m['Name']) !!}
					{!! Form::text($m['Name'],null,['class' => 'month_allocation']) !!}			 		
		 		</div>
			@endforeach
		 	
	 	</div>
	 	<div class="row">
		 	<div class="small-6 left">
		 		<h4 class="small">Allocated: $<span id="total">0.00</span></h4>
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
	
	$form.delegate('.month_allocation', 'change', function ()
	{
	   
	    var sum = 0;
	    $summands.each(function ()
	    {
	        var value = Number($(this).val());
	        if (!isNaN(value)) sum += value;
	    });

		$sumDisplay.text(sum.toFixed(2));
		
		if (sum == {{ $payment->amount }})
		$('#submit_button').removeAttr('disabled');
		else
		$('#submit_button').attr('disabled','disabled');
	
	    
	});


 
});	
