  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	<p><a href="/tenants/create" class="button radius">Add a Tenant</a></p>
	<table class="table table-striped table-condensed" id="tenants" width="100%">
		<thead>
		<tr>
			<th align="center" style="cursor:pointer">Name</th>
			<th align="center" style="cursor:pointer">Phone</th>
			<th align="center" style="cursor:pointer">Email</th>
			<th align="center" style="cursor:pointer">Current Lease</th>
		</tr>
		</thead>
		<tbody>
			@forelse($tenants as $tenant)
				<tr>
					<td><a href="/tenants/{{ $tenant->id }}">{{ $tenant->firstname . " " . $tenant->lastname }}</a></td>
					<td>{{ $tenant->phone }} </td>
					<td><a href="mailto:{{$tenant->email}}">{{$tenant->email}} </td>
					<td>
						@if(isset($tenant->currentLease()->id))
							<a href="{{route('apartments.lease.show',['name' => $tenant->currentLease()->apartment->name, 'id' => $tenant->currentLease()->id])}}">{{$tenant->currentLease()->apartment->property->name. " " . $tenant->currentLease()->apartment->name}}</a>
						@endif 
					</td>
				</tr>
			@empty
			@endforelse		
		</tbody>
	</table>


@stop
@section('scripts')
<script>
$(document).ready( function () {

	$(document).ready(function() {
	    $('#tenants').DataTable({
		    "searching": true,
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