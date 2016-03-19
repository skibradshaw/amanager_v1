@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
<a href="{{ route('apartments.lease.fees.create',['name' => $lease->apartment->name, 'id' => $lease->id]) }}" class="button radius small">Assess Fees</a>  or <a href="{{ URL::previous() }}">Go Back ></a>
		<table class="table table-striped table-condensed responsive" id="Fees" width="100%">
			<thead>
			<tr>
				<th align="center" style="cursor:pointer">Date</th>
				<th align="center" style="cursor:pointer">Amount</th>
				<th align="center" style="cursor:pointer">Note</th>
				<th align="center" style="cursor:pointer">Delete</th>
			</tr>
			</thead>
			<tbody>
				@forelse($fees as $fee)
					<tr>
						<td><a href="{{ route('apartments.lease.fees.edit',['name' => $lease->apartment->name,'lease' => $lease->id,'id' => $fee->id]) }} ">{{$fee->due_date->format('n/j/Y') }} </a>
						</td>
						<td>{{ number_format($fee->amount,2) }} </td>
						<td>{{ $fee->note }}</td>
						<td><a href="{{ route('apartments.lease.fees.delete',['name' => $lease->apartment->name,'lease' => $lease->id,'id' => $fee->id]) }}" class="del">Delete</a>
						</td>
					</tr>
				@empty
				@endforelse		
			</tbody>
		</table>
	<hr>
	@include('leases.partials.ledger')		
@stop
@section('scripts')
<script type="text/javascript">
$( document ).ready(function() {

 	//JQuery Confirm Fee Delete
   $(".del").click(function(){
	    event.preventDefault();
	    var r=confirm("Are you sure you want to delete?");
	    if (r==true)   {  
	       window.location = $(this).attr('href');
	    }
   });

   //Sort Fee Table
    $('#fees').DataTable({
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
});	


</script>
@stop