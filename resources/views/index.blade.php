  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	<h4>Outstanding Payments: ${{ number_format($current_balance,2) }}</h4>
	<div class="row">
		<div class="large-4 columns">
			@foreach($current_leases as $lease)
				@if($lease->openBalance() != 0)
					{{ $lease->apartment->name }} - Open Balance: ${{ number_format($lease->openBalance(),2) }}<br>
				@endif
			@endforeach
		</div>
	</div>
@stop