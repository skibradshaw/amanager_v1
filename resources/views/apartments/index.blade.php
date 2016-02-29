  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1> <i class="fa fa-building-o fa-1x"></i> {{ $title or 'A Manager' }}</h1>
@stop
@section('content')
<p><a href="apartments/create" class="button radius">Create a New Apartment</a></p>
	<table class="table table-striped table-condensed responsive" id="apartments" width="100%">
	<thead>
	<tr>
		<th align="center" style="cursor:pointer">Property</th>
		<th align="center" style="cursor:pointer">Apartment</th>
		<th align="center" style="cursor:pointer">Open Balance</th>
		<th align="center" style="cursor:pointer"></th>
		<th align="right" style="cursor:pointer" class="text-center">Current Lease</th>
		<th align="center" style="cursor:pointer"></th>
		<th align="left" style="cursor:pointer" class="text-center">Next Lease Starts</th>
	</tr>
	</thead>
	<tbody>

			@forelse($apartments as $a)
				<tr>
					@if(isset($a->currentLease()->id))
						<td><a href="{{ route('apartments.show',[$a->name]) }}">{{ $a->property->name }}</a></td>
						<td>{{$a->name}}</td>
						<td align="right"class="text-right">${{ number_format($a->currentLease()->openBalance(),2) }}</td>
						<td align="right" class="text-right">
							{{ $a->currentLease()->startdate->format('n/j/y') }}
						</td>
						<td align="center" class="text-center" nowrap>
								<a href="{{ route('apartments.lease.show',['name' => $a->name, 'id' => $a->currentLease()->id]) }} ">
								<div class="progress small-12 round">
									<span class="meter text-center" style="width: {{ $a->currentLease()->progress()*100 }}%"></span>
								</div>
								</a>
						</td>
						<td align="left" class="text-left">
							{{ $a->currentLease()->enddate->format('n/j/y') }}
						</td>
					@else
						<td><a href="{{ route('apartments.show',[$a->name]) }}">{{ $a->property->name }}</a></td>
						<td>{{$a->name}}</td>
						<td align="right"class="text-right">&nbsp</td>
						<td align="center" class="text-center">&nbsp</td>
						<td align="center" class="text-center">&nbsp</td>
						<td align="center" class="text-center">&nbsp</td>

					@endif

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
		    "searching": false,
		    "lengthChange": false,
		    "paging": false,
		    "info": true,
/*
			//Hides a column
			"columnDefs": [
			    { "targets": [4], "visible": false }
			  ],
*/
			"dom":' <"search"f><"top"l>rt<"bottom"ip><"clear">',
			//"order":[[0,'asc'],[4,'asc']]		    
	    });
	} );    
    
} );

</script>



@stop