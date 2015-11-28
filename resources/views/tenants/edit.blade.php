  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')

	@if(isset($tenant))
		{!! Form::model($tenant,['route' => ['tenants.update',$tenant->id],'method' => 'put']) !!}
		
	@else
		{!! Form::open(['route' => 'tenants.store']) !!}
		@if($lease_id > 0)
		{!! Form::hidden('lease_id',$lease_id) !!}
		@endif
	@endif
	{!! Form::hidden('type','tenant') !!}
	<div class="row collapse">
		<div class="row collapse">
			<div class="large-2 columns">
				{!! Form::label('firstname','First Name',['id' => 'firstname','class' => 'inline']) !!}				
			</div>
			<div class="large-4 columns left">
				{!! $errors->first('firstname','<span class="label alert radius">:message</span>') !!}
				{!! Form::text('firstname') !!}
			</div>
		</div>
		<div class="row collapse">
			<div class="large-2 columns">
				{!! Form::label('lastname','Last Name',['id' => 'lastname','class' => 'inline']) !!}
			</div>
			<div class="large-4 columns left">
				{!! $errors->first('lastname','<span class="label alert radius">:message</span>') !!}
				{!! Form::text('lastname') !!}
			</div>
		</div>
		<div class="row collapse">
			<div class="large-2 columns">
				{!! Form::label('email','Email Address',['id' => 'email','class' => 'inline']) !!}
			</div>
			<div class="large-4 columns left">
				{!! $errors->first('email','<span class="label alert radius">:message</span>') !!}
				{!! Form::email('email') !!}
			</div>
		</div>
		<div class="row collapse">
			<div class="large-2 columns">
				{!! $errors->first('phone','<span class="label alert radius">:message</span>') !!}
				{!! Form::label('phone','Phone',['id' => 'phone','class' => 'inline']) !!}
			</div>
			<div class="large-4 columns left">
				{!! Form::text('phone') !!}
			</div>
		</div>
		<div class="row collapse">
			<div class="large-2 columns">
				{!! Form::label('license','License Plate',['id' => 'license','class' => 'inline']) !!}
			</div>
			<div class="large-1 columns">
				{!! Form::text('license_state',null,['placeholder' => 'ST']) !!}
			</div>
			<div class="large-1 columns">
			</div>			
			<div class="large-3 columns left">
				{!! Form::text('license_plate',null,['placeholder' => 'License Plate #']) !!}
			</div>
		</div>
		
	</div>
	<button type="submit" class="radius button">{{ $button }}</button>
	
	
	{!! Form::close() !!}

@stop