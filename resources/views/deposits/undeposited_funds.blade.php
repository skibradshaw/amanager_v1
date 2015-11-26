  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	
	{!! Form::open(['route' => ['deposit.confirm'], 'method' => 'post', 'id' => 'deposit']) !!}
	<table role="grid" class="table table-striped table-condensed responsive" id="payments" width="100%">
	<thead>
	<tr>
		<th align="right" style="cursor:pointer">Apartment</th>
		<th align="center" style="cursor:pointer">Tenant</th>
		<th align="center" class="text-center" style="cursor:pointer">Payment Date</th>
		<th align="right" style="cursor:pointer" class="text-center">Amount</th>
		<th align="right" class="text-right switch">{!! Form::checkbox('selectall',null,false,['id' => 'selectall']) !!} <label class="switch-paddle" for="selectall"><span class="show-for-sr">All</span></label></th>
	</tr>
	</thead>
		<tbody>
		@forelse($payments as $p)
			<tr>
				<td>{{ $p->lease->apartment->property->name . ' ' . $p->lease->apartment->name }} {!! Form::hidden('payment_id[]',$p->id) !!}</td>
				<td>{{ $p->tenant->fullname }}</td>
				<td align="center" class="text-center">{{ $p->paid_date->format('n/j/Y') }}</td>
				<td align="right" class="text-right">${{ number_format($p->amount,2) }}</td>
				<td class="switch text-right" align="right">{!! Form::checkbox('paymentid_'.$p->id,$p->amount,true,['class' => 'payment switch-input', 'id' => 'paymentid_'.$p->id]) !!} <label class="switch-paddle" for="paymentid_{{$p->id}}"><span class="show-for-sr">Select</span></label> </td>				
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
				<td><strong>Undeposited Payments:</strong></td>
				<td></td>
				<td></td>
				<td></td>
				<td align="right" class="text-right">${{ number_format($total,2) }}</td>
			</tr>
		</tfoot>
	</table> 
	<h3 class="text-right">Selected Total: $<span id="total">{{ number_format($total,2) }}</span></h3>
	<button type="submit" class="radius button right">Make Deposit</button>
	{!! Form::hidden('deposit_total',$total,['id' => 'deposit_total']) !!}
	{!! Form::close() !!}

  <div id="makeDeposit" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

  </div>

@stop
@section('scripts')
<script>
$(document).ready( function () {
    $('#payments').DataTable({
	    "searching": false,
	    "lengthChange": false,
	    "paging": false,
	    "info": false,
		"dom":' <"search"f><"top"l>rt<"bottom"ip><"clear">',
		"order":[[0,'asc'],[3,'asc']]		    
    });

	//Show Selected Total
	$(".payment").click(function(event) {
		var total = 0;
		$(".payment:checked").each(function() {
			total += parseInt($(this).val());
		});
		//alert(total);
		$('#deposit_total').val(total);
		total = numberWithCommas(total.toFixed(2))
		$('#total').text(total);

	});
	//Select All
    $("#selectall").change(function(){
      $(".payment").prop('checked', $(this).prop("checked"));
     });









});
</script>
@stop