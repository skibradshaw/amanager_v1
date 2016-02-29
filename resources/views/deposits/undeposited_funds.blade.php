  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
@if($rentpayments->sum('amount') <> 0)
	<h2><small>Undeposited Rent & Fee Payments</small></h2>
	{!! Form::open(['route' => ['deposit.confirm'], 'method' => 'post', 'id' => 'rentdeposit']) !!}
	<table role="grid" class="table table-striped table-condensed responsive" id="rentpayments" width="100%">
	<thead>
	<tr>
		<th align="right" style="cursor:pointer">Apartment</th>
		<th align="center" style="cursor:pointer">Tenant</th>
		<th align="center" class="text-center" style="cursor:pointer">Payment Date</th>
		<th align="right" style="cursor:pointer" class="text-center">Amount</th>
<!-- 		<th align="right" class="text-right switch">{!! Form::checkbox('selectall',0,true,['id' => 'selectallrent','class' => ' rentpayment']) !!} <label class="switch-paddle" for="selectallrent"><span class="show-for-sr">All</span></label></th> -->
		<th align="right" class="text-right">Include?</th>
	</tr>
	</thead>
		<tbody>
		@forelse($rentpayments as $r)
			<tr>
				<td>{{ $r->lease->apartment->property->name . ' ' . $r->lease->apartment->name }} {!! Form::hidden('payment_id[]',$r->id) !!}</td>
				<td>{{ $r->tenant->fullname }}</td>
				<td align="center" class="text-center">{{ $r->paid_date->format('n/j/Y') }}</td>
				<td align="right" class="text-right">${{ number_format($r->amount,2) }}</td>
				<td class="switch text-right" align="right">{!! Form::checkbox('paymentid_'.$r->id,$r->amount,true,['class' => 'rentpayment switch-input', 'id' => 'paymentid_'.$r->id]) !!} <label class="switch-paddle" for="paymentid_{{$r->id}}"><span class="show-for-sr">Select</span></label> 
				</td>				
			</tr>			
		@empty
			<tr>
				<td>No Undeposited Payments Found</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		@endforelse
		</tbody>
		<tfoot>
			<tr>
				<td><strong>Undeposited Rents & Feess:</strong></td>
				<td></td>
				<td></td>
				<td></td>
				<td align="right" class="text-right">${{ number_format($rentpayments->sum('amount'),2) }}</td>
			</tr>
		</tfoot>
	</table> 
	<h3 class="text-right">Selected Total: $<span id="rtotal">{{ number_format($rentpayments->sum('amount'),2) }}</span></h3>
	<button type="submit" class="radius button right"{{ ($rentpayments->sum('amount') == 0) ? ' disabled ' : null }}>Create a Deposit</button>
	{!! Form::hidden('deposit_total',$rentpayments->sum('amount'),['id' => 'rent_total']) !!}
	{!! Form::close() !!}
@else
	<h2><small>There are no Undeposited Rent or Fee Payments</small></h2>
@endif
	<hr>
@if($depositpayments->sum('amount') <> 0)
 	<h2><small>Undeposited Deposit Payments</small></h2>
	{!! Form::open(['route' => ['deposit.confirm'], 'method' => 'post', 'id' => 'depositdeposit']) !!}
	<table role="grid" class="table table-striped table-condensed responsive" id="depositpayments" width="100%">
	<thead>
	<tr>
		<th align="right" style="cursor:pointer">Apartment</th>
		<th align="center" style="cursor:pointer">Tenant</th>
		<th align="center" class="text-center" style="cursor:pointer">Payment Date</th>
		<th align="right" style="cursor:pointer" class="text-center">Amount</th>
<!-- 		<th align="right" class="text-right switch">{!! Form::checkbox('selectall',null,false,['id' => 'selectalldeposit']) !!} <label class="switch-paddle" for="selectalldeposit"><span class="show-for-sr">All</span></label></th> -->
		<th align="right" class="text-right">Include?</th>
	</tr>
	</thead>
		<tbody>
		@forelse($depositpayments as $d)
			<tr>
				<td>{{ $d->lease->apartment->property->name . ' ' . $d->lease->apartment->name }} {!! Form::hidden('payment_id[]',$d->id) !!}</td>
				<td>{{ $d->tenant->fullname }}</td>
				<td align="center" class="text-center">{{ $d->paid_date->format('n/j/Y') }}</td>
				<td align="right" class="text-right">${{ number_format($d->amount,2) }}</td>
				<td class="switch text-right" align="right">{!! Form::checkbox('paymentid_'.$d->id,$d->amount,true,['class' => 'depositpayment switch-input', 'id' => 'paymentid_'.$d->id]) !!} <label class="switch-paddle" for="paymentid_{{$d->id}}"><span class="show-for-sr">Select</span></label> </td>				
			</tr>			
		@empty
			<tr>
				<td>No Undeposited Payments Found</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		@endforelse
		</tbody>
		<tfoot>
			<tr>
				<td><strong>Undeposited Rents & Feess:</strong></td>
				<td></td>
				<td></td>
				<td></td>
				<td align="right" class="text-right">${{ number_format($depositpayments->sum('amount'),2) }}</td>
			</tr>
		</tfoot>
	</table> 
	<h3 class="text-right">Selected Total: $<span id="dtotal">{{ number_format($depositpayments->sum('amount'),2) }}</span></h3>
	<button type="submit" class="radius button right"{{ ($depositpayments->sum('amount') == 0) ? ' disabled ' : null }}>Create a Deposit</button>
	{!! Form::hidden('deposit_total',$depositpayments->sum('amount'),['id' => 'ddeposit_total']) !!}
	{!! Form::close() !!}
@else
	<h2><small>There are no Undeposited Deposit Payments</small></h2>
@endif

  <div id="makeDeposit" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

  </div>

@stop
@section('scripts')
<script>
$(document).ready( function () {
    $('#rentpayments').DataTable({
	    "searching": false,
	    "lengthChange": false,
	    "paging": false,
	    "info": false,
		"dom":' <"search"f><"top"l>rt<"bottom"ip><"clear">',
		"order":[[0,'asc'],[3,'asc']]		    
    });

    $('#depositpayments').DataTable({
	    "searching": false,
	    "lengthChange": false,
	    "paging": false,
	    "info": false,
		"dom":' <"search"f><"top"l>rt<"bottom"ip><"clear">',
		"order":[[0,'asc'],[3,'asc']]		    
    });

	//Show Selected Rent Total
	$(".rentpayment").change(function(event) {
		var total = 0;
		$(".rentpayment:checked").each(function() {
			total += parseInt($(this).val());
		});
		//alert(total);
		$('#rent_total').val(total);
		total = numberWithCommas(total.toFixed(2))
		$('#rtotal').text(total);

	});

	//Show Selected Deposit Total
	$(".depositpayment").change(function(event) {
		var total = 0;
		$(".depositpayment:checked").each(function() {
			total += parseInt($(this).val());
		});
		//alert(total);
		$('#ddeposit_total').val(total);
		total = numberWithCommas(total.toFixed(2))
		$('#dtotal').text(total);

	});
	//Select All
    $("#selectallrent").change(function(){
      $(".rentpayment").prop('checked', $(this).prop("checked"));
     });
    $("#selectalldeposit").change(function(){
      $(".depositpayment").prop('checked', $(this).prop("checked"));
     });








});
</script>
@stop