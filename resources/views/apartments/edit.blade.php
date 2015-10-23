  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>Apartment</h1>
@stop
@section('content')
	@if(isset($model))
	{!! Form::model($model,['route' => 'apartments.update']) !!}
	@else
	{!! Form::open(['route' => 'apartments.create']) !!}
	@endif

   <div class="row collapse">
    <div class="large-2 columns">
      <label class="inline">Apartment Name</label>
   </div>
   <div class="large-10 columns">
      <input type="text" id="name" name="name" placeholder="CS1">
    </div>
   </div>
   <div class="row collapse">
    <div class="large-2 columns">
      <label class="inline">Apartment #</label>
   </div>
   <div class="large-10 columns">
      <input type="text" id="number" name="name" placeholder="1">
    </div>
   </div>
   <div class="row collapse">
    <div class="large-2 columns">
      <label class="inline">Property</label>
   </div>
   <div class="large-10 columns">
      <input type="text" id="name" name="name" placeholder="CS1">
    </div>
   </div>

   <button type="submit" class="radius button">Submit</button>
   {!! Form::close() !!}


@stop