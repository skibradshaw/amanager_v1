@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	<table class="table table-striped table-condensed" id="apartments" width="100%">
	<thead>
	<tr>
		<th align="center" style="cursor:pointer">Apartment</th>
		<th align="center" style="cursor:pointer">Deposit Required</th>
		<th align="center" style="cursor:pointer">Balance Due</th>
		<th align="right" style="cursor:pointer" class="text-center">View Lease</th>
		<th align="left" style="cursor:pointer" class="text-center">Send Reminder</th>
	</tr>
	</thead>
	<tbody>
			@foreach($current_leases as $lease)
				@if($lease->depositBalance() != 0)
				<tr>
					<td>
						{{ $lease->apartment->property->name . " " . $lease->apartment->name }}
					</td>
					<td align="right" class="text-right">
						${{ number_format($lease->leaseDeposits()->sum('amount'),2) }}
					</td>
					<td align="center" class="text-center">
						${{ number_format($lease->depositBalance(),2) }}
					</td>
					<td align="center" class="text-center">
						<a href="{{ route('apartments.lease.show',['name' => $lease->apartment->name, 'id' => $lease->id]) }} ">View Lease</a>
					</td>
					<td align="center" class="text-center">
						<a href="#">Send Reminder</a>
					</td>
				</tr>
				@endif
			@endforeach
	</tbody>
	</table> 	
@stop
@section('scripts')
<script>
$(document).ready( function () {

	$(document).ready(function() {
	    $('#apartments').DataTable({
		    "searching": false,
		    "lengthChange": false,
		    "info": true,
		    "paging": false,
/*
			//Hides a column
			"columnDefs": [
			    { "targets": [4], "visible": false }
			  ],
*/
			"dom":' <"search"f><"top"l>rt<"bottom"ip><"clear">',
			"order":[[0,'asc'],[4,'asc']]		    
	    });
	} );    
    
} );

</script>



@stop