  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')

@foreach($properties as $p)
	<h4>{{$p->name}} Overview</h4>
	<div class="row">
		<div class="large-3 columns">
			<a href="{{ route('reports.rentsdue',['id' => $p->id]) }}">
			<div class="panel text-center radius">
				<h1><i class="fa fa-usd fa-1x"></i></h1>
				<h4>Rents Due<br>${{ number_format($p->rentBalance()) }}</h4>
			</div>
			</a>
		</div>
		<div class="large-3 columns">
			<a href="{{ route('reports.depositsdue',['id' => $p->id]) }}">
			<div class="panel text-center radius">
				<h1><i class="fa fa-lock fa-1x"></i></h1>
				<h4>Deposits Due<br>${{ number_format($p->depositBalance()) }}</h4>
			</div>
			</a>
		</div>
		<div class="large-3 columns end">
			<!-- <a href="{{ route('tenants.index',['id' => $p->id]) }}"> -->
			<div class="panel text-center radius">
				<h1><i class="fa fa-user fa-1x"></i></h1>
				<h4>Tenants<br>{{ number_format($p->tenants()) }}</h4>
			</div>
			</a>
		</div>
		<div class="large-3 columns end">
			<!-- <a href="{{ route('properties.apartments.index') }}"> -->
			<div class="panel text-center radius">
				<h1><i class="fa fa-building-o fa-1x"></i></h1>
				<h4>Apartments<br>{{ number_format($p->apartments()->count('apartments.id')) }}</h4>
			</div>
			</a>
		</div>
	</div>
	<hr>
@endforeach




@stop