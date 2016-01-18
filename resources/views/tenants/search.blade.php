
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
{!! Form::open(['route' => 'tenants.search']) !!}
	{!! Form::label('name','Search Tenant Name') !!}
	{!! Form::text('name',null,['id' => 'q']) !!}

{!! Form::close() !!}


@stop
@section('scripts')
<script type="text/javascript">
$( document ).ready(function() {
 
    // Your code here.

	//Javascript search
	$(function()
	{
		  

		 $( "#q" ).autocomplete({
		  //source: "/tenants/search",
		  source: [
		  	@foreach($tenants as $tenant)
		  	{!! '"' . $tenant->fullname . '",' !!}
		  	@endforeach
		  ],
		  minLength: 1,
		  select: function(event, ui) {
		  	$('#q').val(ui.item.value);
		  }
		});
	});
 
});	

</script>
@stop