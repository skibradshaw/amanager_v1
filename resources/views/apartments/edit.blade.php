  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>Apartment</h1>
@stop
@section('content')
	@if(isset($apartment))
	{!! Form::model($apartment,['route' => ['apartments.update',$apartment->id],'method' => 'put']) !!}
	@else
	{!! Form::open(['route' => 'apartments.store']) !!}
	@endif

  <div class="row collapse">
  <div class="row collapse">
    <div class="large-2 columns">
      <label class="inline">Choose Property</label>
   </div>
   <div class="large-4 columns left">
      {!! Form::select('properties_id',$properties) !!}
    </div>
  </div> 
  <div class="row collapse">
    <div class="large-2 columns">
      <label class="inline">Apartment #</label>
   </div>
   <div class="large-1 columns left">
      {!! Form::text('number') !!}
    </div>
   </div>
    <div class="large-2 columns">
      
      <label class="inline">Apartment Name</label>
   </div>
   <div class="large-4 columns left">
      {!! Form::text('name') !!}
    </div>
   </div>
 
 

 	@if(isset($apartment))
		<button type="submit" class="radius button">Update</button>
		
	@else
		<button type="submit" class="radius button">Submit</button>
	@endif	
  {!! Form::close() !!}


@stop