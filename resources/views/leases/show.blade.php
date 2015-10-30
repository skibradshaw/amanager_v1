  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
  <div class="row">

    <div class="large-6 columns">
    	<h3><small>Rental Info</small></h3>
    	<div class="panel">
	    	Lease Begin & End:  {{ $lease->startdate->format('n/j/y') }}-{{ $lease->enddate->format('n/j/y') }}<br>
	    	Apartment Rent: ${{ number_format($lease->month_rent,2) }}<br>
	    	Pet Rent: <br>
	    	Misc Fees: <br>
	    	Late Fees: <br>	    	
    	</div>  
    </div>
    <div class="large-6 columns">
    	<h3><small>Residents</small></h3>
    	<div class="panel">
	    	
    	<a href="#" class="button radius tiny" data-reveal-id="myModal">Add Tenant</a>
    	</div>        
    </div>

  </div>


  <div id="myModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
	 {!! Form::open(['route' => 'tenants.search']) !!}
		{!! Form::label('name','Search Tenant Name') !!}
		{!! Form::text('name',null,['id' => 'q']) !!}
	
     {!! Form::close() !!} 	
  <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>

@stop
@section('scripts')
<script type="text/javascript">
$( document ).ready(function() {
 
    // Your code here.

	//Javascript search
	$(function()
	{
		 $( "#q" ).autocomplete({
		  source: "/tenants/search",
		  minLength: 3,
		  appendTo: "#myModal",
		  select: function(event, ui) {
		  	$('#q').val(ui.item.value);
		  }
		});
	});
 
});	

</script>

@stop