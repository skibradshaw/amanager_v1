  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	<table class="table table-striped table-condensed" id="payments" width="100%">
	<thead>
	<tr>
		<th align="center" style="cursor:pointer">Apartment</th>
		<th align="center" style="cursor:pointer">Tenant</th>
		<th align="center" style="cursor:pointer">Type</th>
		<th align="center" style="cursor:pointer">Payment Date</th>
		<th align="right" style="cursor:pointer" class="text-center">Amount</th>
	</tr>
	</thead>
		<tbody>
		@forelse($payments as $p)
			<tr>
				<td>{{ $p->lease->apartment->property->name . ' ' . $p->lease->apartment->name }}</td>
				<td>{{ $p->tenant->fullname }}</td>
				<td>{{ $p->payment_type }}</td>
				<td>{{ $p->paid_date->format('n/j/Y') }}</td>
				<td align="right" class="text-right">${{ number_format($p->amount,2) }}</td>
			</tr>			
		@empty
			<tr>
				<td>No Undeposited Payments Found</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		@endforelse
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4" align="right" class="text-right"><strong>Total Deposit:</strong></td>
				<td align="right" class="text-right">${{ number_format($total,2) }}</td>
			</tr>
		</tfoot>
	</table> 	
@stop
@section('scripts')
<script>
$(document).ready( function () {
    $('#payments').DataTable({
	    "searching": true,
	    "lengthChange": false,
	    "paging": false,
	    "info": false,
		"columnDefs": [
		    { "targets": [5], "visible": false }
		  ],
		"dom":' <"search"f><"top"l>rt<"bottom"ip><"clear">',
		"order":[[0,'asc'],[5,'asc']]		    
    });
} );
</script>



@stop