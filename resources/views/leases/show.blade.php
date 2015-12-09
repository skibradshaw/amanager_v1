  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
	@if($lease->openBalance() != 0)
	<div class="alert-box success radius">Open Balance: ${{ number_format($lease->openBalance(),2) }}</div>
	@endif
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	
  <div class="row">

    <div class="large-4 columns">
    	<h2><small>Rental Info</small></h2>
		<div class="panel">
		    	Lease:  {{ $lease->startdate->format('n/j/y') }}-{{ $lease->enddate->format('n/j/y') }}<br>
		    	Apartment Rent: ${{ number_format($lease->monthly_rent,2) }}<br>
		    	Pet Rent: ${{ number_format($lease->pet_rent,2) }}<br>
		    	Total Fees: ${{ number_format($lease->totalfees,2) }} 
		    	<hr>
				<a href="#" class="button radius tiny" data-reveal-id="myModal">Add Tenant</a>	
				<a href="{{ route('apartments.lease.fees.create',['name' => $lease->apartment->name, 'id' => $lease->id]) }}" class="button radius tiny">Assess Fees</a>		    	
		</div>

    </div>
	<div class="large-8 columns">
 	    <h2><small>Deposits</small></h2>
			<div class="panel">
				<div class="row">
				<div class="large-4 columns">
					Rent Deposit: ${{ number_format($lease->deposit,2) }}<br>
					Pet Deposit: ${{ number_format($lease->pet_deposit,2) }}<br> 
					<strong>Total: ${{ number_format($lease->deposit+$lease->pet_deposit,2) }}</strong>	<br>
					<p>
						<a href="{{ route('apartments.lease.payments.create',['name' => $lease->apartment->name, 'id' => $lease->id]) }}?type=Deposit" class="button radius tiny">Add Deposit Payment</a>
					</p>

				</div>
				<div class="large-8 columns right">
					  <table id="deposit" class="responsive" width="100%">
						<thead>
							<tr>
							  <th>Tenant</th>
							  <th nowrap="" align="right" class="text-right">Deposit Payments</th>
							</tr>
						</thead>
						<tbody>
							@foreach($lease->tenants as $t)
							<tr>
								<td>{{ $t->fullname }}</td>
								<td align="right" class="text-right">${{ number_format($lease->payments()->where('tenant_id',$t->id)->where('payment_type','Deposit')->sum('amount'),2) }}</td>
							</tr>
							@endforeach

						</tbody>
						<tfoot>
							<tr>
								<td><strong>Total Paid:</strong></td>
								<td align="right" class="text-right"><strong>${{ number_format($lease->payments()->where('payment_type','Deposit')->sum('amount'),2) }}</strong></td>
							</tr>
						</tfoot>
					</table>
				</div>
					
				</div>

			</div> 	    			    	
	</div>
  </div>
  <div class="row">
    <div class="large-12 columns">
    	<h2><small>Residents</small></h2>
	    	@foreach($lease->tenants as $tenant)
			<ul class="vcard">
			  <li class="fn">{{ $tenant->fullname }}</li>
			  <li class="fn">{{ $tenant->phone }}</li>
			  <li class="email"><a href="mailto:{{ $tenant->email }}">{{ $tenant->email }}</a></li>
			  <li><a href="{{ route('apartments.lease.payments.create',['name' => $lease->apartment->name, 'id' => $lease->id]) }}?tenant_id={{ $tenant->id}}" class="label radius">Record Payemnt</a></li>
			</ul>			    	
    		  
	    	@endforeach	    			    	
    </div>  	
  </div>
  <div class="row">
	  <div class="large-{{ count($lease->leaseMos()) }} columns">
		  <h2><small>Ledger</small></h2>
		  <table id="ledger" class="responsive ledger" width="100%">
			<thead>
				<tr>
				  <th>Payments</th>
				  @foreach($lease->leaseMos() as $m)
				  	<th nowrap=""> {{ $m['Name'] }} </th>
				  @endforeach
				</tr>
			</thead>	
			<tbody>
				@foreach($lease->tenants as $t)
					<tr>
						<td> {{ $t->lastname }} </td>

						@foreach($lease->leaseMos() as $m)
						{{-- TODO: Remove Hyperlink is Value is $0 --}}	
							
							@if($lease->payments()->where('tenant_id',$t->id)->whereRaw('MONTH(paid_date) = ' . $m['Month'])->whereRaw('YEAR(paid_date) = '. $m['Year'])->count('id') == 0)
							
								<td align="right" class="text-right" nowrap>${{ number_format($lease->monthAllocation($t->id,$m['Month'],$m['Year']),2) }}</td>
							@elseif($lease->payments()->where('tenant_id',$t->id)->whereRaw('MONTH(paid_date) = ' . $m['Month'])->whereRaw('YEAR(paid_date) = '. $m['Year'])->count('id') == 1)
							<td align="right" class="text-right" nowrap><a href="{{ route('apartments.lease.payments.allocate',['name' => $lease->apartment->name, 'lease_id' => $lease->id, 'payment_id' => $lease->payments()->where('tenant_id',$t->id)->whereRaw('MONTH(paid_date) = ' . $m['Month'])->whereRaw('YEAR(paid_date) = ' . $m['Year'])->first()->id]) }}" data-reveal-id="allocatePayment" data-reveal-ajax="true">$
								{{ number_format($lease->monthAllocation($t->id,$m['Month'],$m['Year']),2) }}
								</a></td>							
							@elseif($lease->payments()->where('tenant_id',$t->id)->whereRaw('MONTH(paid_date) = ' . $m['Month'])->whereRaw('YEAR(paid_date) = '. $m['Year'])->count('id') > 1)							
							<td align="right" class="text-right" nowrap><a href="{{ route('apartments.lease.payments.choose',['name' => $lease->apartment->name, 'lease_id' => $lease->id]) }}?tenant_id={{ $t->id }}" data-reveal-id="choosePayment" data-reveal-ajax="true">
								${{ number_format($lease->monthAllocation($t->id,$m['Month'],$m['Year']),2) }}
								</a>
							</td>
							@endif
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
		                <th align="right" class="text-right" nowrap>${{ number_format($lease->monthly_rent * $m['Multiplier'],2) }} </th>
		            @endforeach
	            </tr>					            
				<tr>
				    <th>Pet Rent</th>
					@foreach($lease->leaseMos() as $m)									
					    <td align="right" class="text-right" nowrap>${{ number_format($lease->pet_rent * $m['Multiplier'],2) }} </td>
					@endforeach
				</tr>
				<tr>
					<td>Fees</td>
					@foreach($lease->leaseMos() as $m)									
						<td align="right" class="text-right" nowrap>${{ number_format($lease->monthFees($m['Month'],$m['Year']),2) }}</td>
					@endforeach
				</tr>					            
			</tbody>
			<tfoot>
				<tr>
					<td>Balance</td>
					@foreach($lease->leaseMos() as $m)
						<td align="right" class="text-right" nowrap>${{ number_format($m['Balance'],2) }}</td>
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
		
		<button type="submit" class="radius button tiny">Add to Lease</button> OR <a href="/tenants/create?lease_id={{ $lease->id }}" class="button radius tiny">Create a New Tenant</a>
     {!! Form::close(['class' => 'close-reveal-modal']) !!} 	
	 <a class="close-reveal-modal" aria-label="Close">&#215;</a>
  </div>


  <div id="allocatePayment" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

  </div>

  <div id="choosePayment" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

  </div>

@stop
@section('scripts')
<script type="text/javascript">
$( document ).ready(function() {
 
    // Your code here.

	//Jquery autocomplete search
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