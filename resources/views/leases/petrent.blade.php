<h3>Adjust Pet Rent</h3>
{!! Form::open(['route' => ['apartments.lease.petrent','name' => $lease->apartment->name, 'lease_id' => $lease->id],'method' => 'post','id' => 'petrent']) !!}
<div class="row">
	<div class="row collapse">
		<div class="small-2 columns left">
			{!! Form::label('monthly_pet_rent','Set Pet Rent: ') !!}
		</div>
	   <div class="small-1 columns">
	      <span class="prefix">$</span>
	    </div>	    
		<div class="small-2 columns">
			{!! Form::text('monthly_pet_rent',null,['id' => 'monthly_pet_rent']) !!}
		</div>	
		<!-- <div class="small-1 columns">&nbsp;</div> -->
		<div class="small-4 columns center end">
			<p><a href="#" class="button tiny radius" id="applyall">Apply to All Months</a></p>
		</div>
	</div>
</div> 
@foreach($lease->details as $d)
<div class="row collapse">
	<div class="small-2 columns left">
		{!! Form::label($d->detailName()) !!}
	</div>
   <div class="small-1 columns">
      <span class="prefix">$</span>
    </div>	    
	<div class="small-2 columns end">
		{!! Form::text($d->id,$d->monthly_pet_rent,['class' => 'month_pet_rent', 'id' => $d->detailName()]) !!}
	</div>	
</div>
@endforeach
<button type="submit" id='submit_button' class="radius button tiny">Apply</button>
{!! Form::close(['class' => 'close-reveal-modal']) !!} 
<a class="close-reveal-modal" aria-label="Close">&#215;</a>

<script type="text/javascript">
$( document ).ready(function() {
	$('#applyall').click(function(){
		var $amt = Number($('#monthly_pet_rent').val());
		$('.month_pet_rent').val($amt.toFixed(2));
	}); 


});	
</script>