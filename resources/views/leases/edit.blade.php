  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	@if(isset($lease))
		{!! Form::model($lease,['route' => ['apartments.lease.update','id' => $lease->id],'method' => 'update']) !!}
	@else
		{!! Form::open(['route' => 'apartments.lease.store']) !!}
	@endif
	
	<div class="row collapse">
		<div class="row collapse prefix-radius">
			<div class="small-2 columns inline">
				Lease Dates:
			</div>
			<div class="small-1 columns">
				<span class="prefix">Start:</span>
			</div>
			<div class="small-2 columns">
				{!! Form::text('startdate',null,['id' => 'datepicker','placeholder' => 'mm/dd/yy']) !!}
			</div>
			<div class="small-1 columns">
				<span class="prefix">End:</span>
			</div>
			<div class="small-2 columns left">
				{!! Form::text('enddate',null,['id' => 'datepicker1','placeholder' => 'mm/dd/yy']) !!}
			</div>
		</div>
	</div>
	
	

@stop