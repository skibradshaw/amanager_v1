
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	<div class="row">
		<div class="large-4 columns">
			<table class="table table-striped table-condensed responsive" id="deposits" width="100%">
			<thead>
			<tr>
				<th align="center" style="cursor:pointer">Date</th>
				<th align="center" style="cursor:pointer">Item Count</th>
				<th align="center" style="cursor:pointer">Amount</th>
			</tr>
			</thead>
			<tbody>

			@forelse($deposits as $d)
				<tr>
					<td>{{ $d->deposit_date->format('n/j/Y') }}</a></td>
					<td align="center" class="text-center">{{ $d->payments()->count('id') }}</td>
					<td align="right"class="text-right">${{ number_format($d->amount,2) }}</td>
				</tr>
				
			@empty
				<tr>
					<td>None Found</td>
					<td></td>
					<td></td>
				</tr>
			@endforelse
				</tbody>
			</table>
		</div>
	</div>
		
@stop
@section('scripts')
<script>
$(document).ready( function () {

	$(document).ready(function() {
	    $('#deposits').DataTable({
		    "searching": false,
		    "lengthChange": false,
		    "paging": false,
		    "info": true,

			//Hides a column
			// "columnDefs": [
			// 	{ 'orderData':[0,2], 'targets': [1] },
			//     { "targets": [2], "visible": false }
			//   ],

			"dom":' <"search"f><"top"l>rt<"bottom"ip><"clear">',
			//"order":[[0,'asc'],[4,'asc']]		    
	    });
	} );    
    
} );    
</script>
@stop