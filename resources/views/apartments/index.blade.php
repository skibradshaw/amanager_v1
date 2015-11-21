  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
<p><a href="apartments/create" class="button radius">Create a New Apartment</a></p>
	<table class="table table-striped table-condensed" id="apartments" width="100%">
	<thead>
	<tr>
		<th align="center" style="cursor:pointer">Property</th>
		<th align="center" style="cursor:pointer">Apartment</th>
		<th align="center" style="cursor:pointer">Open Balance</th>
		<th align="right" style="cursor:pointer" class="text-center">Current Lease</th>
		<th align="left" style="cursor:pointer" class="text-center">Next Lease Starts</th>
	</tr>
	</thead>
	<tbody>

	@forelse($apartments as $a)
		<tr>
			<td><a href="{{ route('apartments.show',[$a->name]) }}">{{ $a->property->name }}</a></td>
			<td>{{$a->name}}</td>
			<td align="right"class="text-right">&nbsp;</td>
			<td align="center" class="text-center">
				@if(isset($a->leases()->whereRaw('DATE(NOW()) BETWEEN startdate AND enddate')->first()->id))
					<a href="{{ route('apartments.lease.show',['name' => $a->name, 'id' => $a->leases()->whereRaw('DATE(NOW()) BETWEEN startdate AND enddate')->first()->id]) }} ">{{ $a->leases()->whereRaw('DATE(NOW()) BETWEEN startdate AND enddate')->first()->enddate->format('n/j/Y') }}</a>			
				@endif
			</td>
			<td align="center" class="text-center">
					<a href="{{ route('apartments.lease.create',['name' => $a->name]) }}" class="btn btn-default btn-xs">Create Lease</a>		
			</td>
		</tr>
		
	@empty
		<tr>
			<td>None Added</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	@endforelse
		</tbody>
	</table> 	
@stop
@section('scripts')
<script>
$(document).ready( function () {

	$(document).ready(function() {
	    $('#apartments').DataTable({
		    "searching": true,
		    "lengthChange": false,
		    "paging": true,
		    "info": true,
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