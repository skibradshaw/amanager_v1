  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	<h4>Outstanding Balances: ${{ number_format($current_balance,2) }}</h4>
	<div class="row">
		<div class="large-8 columns">
			@foreach($current_leases as $lease)
				@if($lease->openBalance() != 0)
					<a href="{{ route('apartments.lease.show',['name' => $lease->apartment->name, 'id' => $lease->id]) }} ">{{ $lease->apartment->name }} - Balance due: ${{ number_format($lease->openBalance(),2) }}</a>
					(Paid: 
					@foreach($lease->tenants as $t)
						 {{ $t->lastname . ': $' . number_format($t->payments()->where('lease_id',$lease->id)->sum('amount'),2) }}
					@endforeach
					)
					<br>
				@endif
			@endforeach
		</div>
	</div>
@stop