  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	@if(isset($apartment))
	{!! Form::model($apartment,['route' => ['properties.apartments.update',$property->id,$apartment->id],'method' => 'put']) !!}
	@else
	{!! Form::open(['route' => ['properties.apartments.store',$property->id]]) !!}
	@endif
  {!! Form::hidden('property_id',$property->id) !!}
<div class="row collapse">
    <div class="large-2 columns">
      <label class="inline">Apartment #</label>
   </div>
   <div class="large-1 columns left">
      {!! $errors->first('number','<span class="label alert radius">:message</span>') !!}
      {!! Form::text('number') !!}
    </div>

</div>
 
 

 	@if(isset($apartment))
		<button type="submit" class="radius button">Update</button>
		
	@else
		<button type="submit" class="radius button">Submit</button>
	@endif	
  {!! Form::close() !!}


@stop