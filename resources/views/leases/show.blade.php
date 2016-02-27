  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
	@if($lease->openBalance() != 0)
	<div class="alert-box success radius">Open Balance: ${{-- number_format($lease->openBalance(),2) --}}</div>
	@endif
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	
	<div class="row" data-equalizer>
	<h2><small>Rental Info</small></h2>
		    <div class="large-12 columns panel" data-equalizer-watch>
		    	
		    		<div class="large-3 columns text-center">
				    	<h5>Lease:<br>  {{ $lease->startdate->format('n/j/y') }}-{{ $lease->enddate->format('n/j/y') }}</h5>
				    </div>
				    <div class="large-3 columns text-center">
				    	<h5>Apartment Rent:<br> ${{ number_format($lease->monthly_rent,2) }}</h5>
				    </div>
				    <div class="large-3 columns text-center">
				    	<h5>Pet Rent:<br> ${{ number_format($lease->pet_rent,2) }}</h5>
				    </div>
				    <div class="large-3 columns text-center">
				    	<h5>Total Fees:<br> ${{ number_format($lease->totalfees,2) }} </h5>
				    </div>
			</div>
	</div>

	<div class="row" data-equalizer>
	<h2><small>Residents</small></h2>
	     <div class="large-12 columns">
		    	@foreach($lease->tenants as $tenant)
				<ul class="vcard">
				  <li class="fn">{{ $tenant->fullname }}</li>
				  <li class="fn">{{ $tenant->phone }}</li>
				  <li class="email"><a href="mailto:{{ $tenant->email }}">{{ $tenant->email }}</a></li>
				  @if($lease->tenants()->where('tenant_id',$tenant->id)->first()->pivot->sublessor_name)
				  <span class="label warning radius">Sub-Lease:</span> <a href="/apartments/{{ $lease->apartment->name }}/lease/{{ $lease->id }}/tenants/{{ $tenant->id }}" data-reveal-id="addSubLease" data-reveal-ajax="true"><span style="font-size: 0.6875rem;">{{ $lease->tenants()->where('tenant_id',$tenant->id)->first()->pivot->sublessor_name }}</span></a></li>
				  @else
				  <li><a href="/apartments/{{ $lease->apartment->name }}/lease/{{ $lease->id }}/tenants/{{ $tenant->id }}" class="label radius warning" data-reveal-id="addSubLease" data-reveal-ajax="true">Add SubLease</a></li>
				  @endif
				  <li><a href="{{ route('apartments.lease.payments.create',['name' => $lease->apartment->name, 'id' => $lease->id]) }}?tenant_id={{ $tenant->id}}" class="label success radius">Record Payemnt</a></li>			  
				</ul>			    	
	    		  
		    	@endforeach
		    <p>		    			    	
	     	<a href="#" class="button radius tiny" data-reveal-id="myModal">Add Tenant</a>	<a href="{{ route('apartments.lease.fees.create',['name' => $lease->apartment->name, 'id' => $lease->id]) }}" class="button radius tiny">Assess Fees</a>
	     	</p>
	     </div>	
    </div>
	<div class="row" data-equalizer>
	<h2><small>Deposit Info</small></h2>
	     <div class="large-12 columns panel">
							<div class="large-4 columns text-center">
								<h5>Rent Deposit: ${{ number_format($lease->leaseDeposits()->where('deposit_type','Damage Deposit')->sum('amount'),2) }}</h5>
							</div>
							<div class="large-4 columns text-center">
								<h5>Pet Deposit: ${{ number_format($lease->leaseDeposits()->where('deposit_type','Pet Deposit')->sum('amount'),2) }}</h5>
							</div>
							<div class="large-4 columns text-center">
								<h5>Total: ${{ number_format($lease->leaseDeposits()->sum('amount'),2) }}</h5>
							</div>	 
		</div>
		<div class="large-12 columns">    
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
							<tr>
								<td><strong>Balance Due:</strong></td>
								<td align="right" class="text-right"><strong>${{ number_format($lease->depositBalance(),2) }}</strong></td>
							</tr>						</tfoot>
					</table>
					<p>
						<a href="{{ route('apartments.lease.payments.create',['name' => $lease->apartment->name, 'id' => $lease->id]) }}?type=Deposit" class="button radius tiny">Add Deposit Payment</a>
					</p>
	     </div>	
    </div>

  <div class="row">
  <h2><small>Ledger</small></h2>
	  <div class="large-{{ $lease->details->count() }} columns">
		  <table id="ledger" class="responsive ledger" width="100%">
			<thead>
				<tr>
				  <th>Payments</th>
				  @foreach($lease->details as $m)
				  	<th nowrap="" align="center" class="text-center"> {{ $m->detailName() }} </th>
				  @endforeach
				</tr>
			</thead>	
			<tbody>
				@foreach($lease->tenants as $t)
					<tr>
						<td> {{ $t->lastname }} </td>

						@foreach($lease->details as $m)
						{{-- TODO: Remove Hyperlink if Value is $0 --}}	
							
							@if($lease->payments()->where('payment_type','Rent')->where('tenant_id',$t->id)->whereRaw('MONTH(paid_date) = ' . $m->month)->whereRaw('YEAR(paid_date) = '. $m->year)->count('id') == 0)
							
								<td align="right" class="text-right" nowrap>${{ number_format($m->monthAllocation($t->id),2) }}</td>
							@elseif($lease->payments()->where('payment_type','Rent')->where('tenant_id',$t->id)->whereRaw('MONTH(paid_date) = ' . $m->month)->whereRaw('YEAR(paid_date) = '. $m->year)->count('id') == 1)
							<td align="right" class="text-right" nowrap><a href="{{ route('apartments.lease.payments.allocate',['name' => $lease->apartment->name, 'lease_id' => $lease->id, 'payment_id' => $lease->payments()->where('payment_type','Rent')->where('tenant_id',$t->id)->whereRaw('MONTH(paid_date) = ' . $m->month)->whereRaw('YEAR(paid_date) = ' . $m->year)->first()->id]) }}" data-reveal-id="allocatePayment" data-reveal-ajax="true">${{ number_format($m->monthAllocation($t->id),2) }}
								</a></td>							
							@elseif($lease->payments()->where('payment_type','Rent')->where('tenant_id',$t->id)->whereRaw('MONTH(paid_date) = ' . $m->month)->whereRaw('YEAR(paid_date) = '. $m->year)->count('id') > 1)							
							<td align="right" class="text-right" nowrap><a href="{{ route('apartments.lease.payments.choose',['name' => $lease->apartment->name, 'lease_id' => $lease->id]) }}?tenant_id={{ $t->id }}" data-reveal-id="choosePayment" data-reveal-ajax="true">
								${{ number_format($m->monthAllocation($t->id),2) }}
								</a>
							</td>
							@endif
						@endforeach
					</tr>
				@endforeach
				<tr>
						<td> &nbsp; </td>

						@foreach($lease->details as $m)									
							<td>&nbsp;</td>
						@endforeach				</tr>			

	            <tr>
		            <td>Rent</td>
					@foreach($lease->details as $m)									
		                <th align="right" class="text-right" nowrap>${{ number_format(($m->monthly_rent),2) }} </th>
		            @endforeach
	            </tr>					            
				<tr>
				    <th>Pet Rent <a href="{{ route('apartments.lease.petrent',['name' => $lease->apartment->name, 'id' => $lease->id]) }}" data-reveal-id="changePetRent" data-reveal-ajax="true">edit</a></th>
					@foreach($lease->details as $m)									
					    <td align="right" class="text-right edit" id="{{$m->id}}" nowrap>{{ number_format(($m->monthly_pet_rent),2) }}</td>
					@endforeach
				</tr>
				<tr>
					<td>Fees</td>
					@foreach($lease->details as $m)									
						<td align="right" class="text-right" nowrap>${{ number_format($lease->monthFees($m->month,$m->year),2) }}</td>
					@endforeach
				</tr>					            
			</tbody>
			<tfoot>
				<tr>
					<td>Balance</td>
					@foreach($lease->details as $m)
						<td align="right" class="text-right" nowrap>$<span id="balance{{$m->id}}">{{ number_format($m->monthBalance(),2) }}</span></td>
					@endforeach
				</tr>
			</tfoot>	
		  </table>
	  </div>
  </div>
  <div class="row">
  	<div class="large-12 columns">
  		<a href="/apartments/{{ $lease->apartment->name }}/lease/{{ $lease->id }}/terminate" class="button radius alert" data-reveal-id="terminateLease" data-reveal-ajax="true">Terminate Lease</a>
  	</div>
  </div>
  <div id="myModal" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
	 {!! Form::open(['route' => 'tenants.add_to_lease']) !!}
		{!! Form::label('name','Search Tenant Name') !!}
		<input id="q" name="name" autofocus type="text">
		{!! Form::hidden('tenant_id',null,['id' => 'tenant_id']) !!}
		{!! Form::hidden('lease_id',$lease->id) !!}
		<button type="submit" id="add" class="radius button tiny" disabled>Add to Lease</button> OR <a href="/tenants/create?lease_id={{ $lease->id }}" class="button radius tiny">Create a New Tenant</a>
     {!! Form::close(['class' => 'close-reveal-modal']) !!} 	
	 <a class="close-reveal-modal" aria-label="Close">&#215;</a>
  </div>


  <div id="allocatePayment" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

  </div>

  <div id="choosePayment" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

  </div>

  <div id="changePetRent" class="reveal-modal medium" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

  </div>

  <div id="addSubLease" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

  </div> 
  
  <div id="terminateLease" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

  </div>

@stop
@section('scripts')
<script type="text/javascript">

$(document).on('opened.fndtn.reveal', '[data-reveal]', function () {
  var modal = $(this);
  modal.find('[autofocus]').focus();
});
$( document ).ready(function() {
	 $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	});
    // Your code here.

	//Jquery autocomplete search
	$(function()
	{
		 $( "#q" ).autocomplete({
		  //source: "/tenants/search",
		  source: [
		  	@foreach($tenants as $tenant)
		  	{!! '{label: "' . $tenant->fullname . '", value: "'. $tenant->id . '"},' !!}
		  	@endforeach
		  ],		  
		  minLength: 0,
		  appendTo: "#myModal",
		  focus: function(event, ui) {
			// prevent autocomplete from updating the textbox
			event.preventDefault();
			// manually update the textbox
			$(this).val(ui.item.label);
			},
		  select: function(event, ui) {
		  	// prevent autocomplete from updating the textbox
			event.preventDefault();
			// manually update the textbox and hidden field
			$(this).val(ui.item.label);
		  	$('#tenant_id').val(ui.item.value);
		  	$('#add').removeAttr('disabled');
		  }
		});
	});

	//Jquery for SubLessor Name must have text to submit
    $('#subleasetenant').keyup(function() {

        var empty = false;
        if ($(this).val().length == 0) {
            empty = true;
        }

        if (empty) {
            $('#add_sublease').attr('disabled', 'disabled');
        } else {
            $('#add_sublease').removeAttr('disabled');
        }
    });
 
});	


</script>


@stop