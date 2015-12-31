  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	<h4>Overview</h4>
	<div class="row">
		<div class="large-3 columns">
			<a href="{{ route('reports.rentsdue') }}">
			<div class="panel text-center radius" style="background-color: #0abaef">
				<h1 style="color: #fff"><i class="fa fa-usd fa-2x" style="color:#fff"></i></h1>
				<h4 style="color: #fff">Rents Due<br>${{ number_format($current_balance) }}</h4>
			</div>
			</a>
		</div>
		<div class="large-3 columns">
			<a href="{{ route('reports.depositsdue') }}">
			<div class="panel text-center radius" style="background-color: #92cd19">
				<h1 style="color: #fff"><i class="fa fa-lock fa-2x" style="color:#fff"></i></h1>
				<h4 style="color: #fff">Deposits Due<br>${{ number_format($deposit_balance) }}</h4>
			</div>
			</a>
		</div>
		<div class="large-3 columns end">
			<a href="{{ route('tenants.index') }}">
			<div class="panel text-center radius" style="background-color: #f39c12">
				<h1 style="color: #fff"><i class="fa fa-user fa-2x" style="color:#fff"></i></h1>
				<h4 style="color: #fff">Tenants<br>{{ number_format($tenants) }}</h4>
			</div>
			</a>
		</div>
		<div class="large-3 columns end">
			<a href="{{ route('apartments.index') }}">
			<div class="panel text-center radius" style="background-color: #f20456">
				<h1 style="color: #fff"><i class="fa fa-building-o fa-2x" style="color:#fff"></i></h1>
				<h4 style="color: #fff">Apartments<br>{{ number_format($apartments) }}</h4>
			</div>
			</a>
		</div>
	</div>




@stop