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
	    	<ul>
		    	@foreach($lease->tenants as $tenant)
		    	<li>{{ $tenant->firstname }} {{ $tenant->lastname }}</li>
		    	@endforeach
	    	</ul>
    	<a href="#" class="button radius tiny" data-reveal-id="myModal">Add Tenant</a>
    	</div>        
    </div>

  </div>
  <div class="row">
	  <div class="large-12 columns">
		  <table id="ledger" class="responsive ledger" width="100%">
			<thead>
				<tr>
				  <th>Payments</th>
				  @foreach($lease->leaseMos() as $m)
				  	<th nowrap=""> {{ $m['Month'] }} - {{ $m['Year'] }} </th>
				  @endforeach
				</tr>
			</thead>	
			<tbody>
				@foreach($lease->tenants as $t)
					<tr>
						<td> {{ $t->lastname }} </td>

						@foreach($lease->leaseMos() as $m)									
							<td>$ </td>
						@endforeach
					</tr>
				@endforeach
				<tr>
						<td> &nbsp; </td>

						@foreach($lease->leaseMos() as $m)									
							<td>&nbsp;</td>
						@endforeach				</tr>			

	            <tr>
		            <td>Rent</td>
					@foreach($lease->leaseMos() as $m)									
		                <th>${{ $lease->monthly_rent }} </th>
		            @endforeach
	            </tr>					            
				<tr>
				    <th>Pet Rent</th>
					@foreach($lease->leaseMos() as $m)									
					    <td>${{ $lease->pet_rent }} </td>
					@endforeach
				</tr>
				<tr>
					<td>Fees</td>
					@foreach($lease->leaseMos() as $m)									
					<td>$0.00</td>
					@endforeach
				</tr>					            
			</tbody>
			<tfoot>
				<tr>
					<td>Balance</td>
					@foreach($lease->leaseMos() as $m)
						<td>$0.00</td>
					@endforeach
				</tr>
			</tfoot>	
		  </table>
	  </div>
  </div>

  <div id="myModal" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
	 {!! Form::open(['route' => 'tenants.add_to_lease']) !!}
		{!! Form::label('name','Search Tenant Name') !!}
		{!! Form::text('name',null,['id' => 'q']) !!}
		{!! Form::hidden('tenant_id',null,['id' => 'tenant_id']) !!}
		{!! Form::hidden('lease_id',$lease->id) !!}
		
		<button type="submit" class="radius button tiny">Add to Lease</button>
     {!! Form::close(['class' => 'close-reveal-modal']) !!} 	
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
		  	$('#tenant_id').val(ui.item.id);
		  }
		});
	});
 
});	

</script>

@stop