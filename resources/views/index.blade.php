  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	<h4>Outstanding Balances: </h4>
	<div class="row">
		<div class="large-3 columns">
			<a href="#">
			<div class="panel text-center radius" style="background-color: #0abaef">
				<h1 style="color: #fff"><i class="fa fa-usd fa-2x" style="color:#fff"></i></h1>
				<h4 style="color: #fff">Rents Due ${{ number_format($current_balance) }}</h4>
			</div>
			</a>
		</div>
		<div class="large-3 columns">
			<div class="panel text-center radius" style="background-color: #92cd19">
				<h1 style="color: #fff"><i class="fa fa-lock fa-2x" style="color:#fff"></i></h1>
				<h4 style="color: #fff">Deposits Due ${{ number_format($current_balance) }}</h4>
			</div>
		</div>
		<div class="large-3 columns end">
			<div class="panel text-center radius" style="background-color: #f39c12">
				<h1 style="color: #fff"><i class="fa fa-user fa-2x" style="color:#fff"></i></h1>
				<h4 style="color: #fff">Tenants<br>{{ number_format($tenants) }}</h4>
			</div>
		</div>
		<div class="large-3 columns end">
			<div class="panel text-center radius" style="background-color: #f20456">
				<h1 style="color: #fff"><i class="fa fa-building-o fa-2x" style="color:#fff"></i></h1>
				<h4 style="color: #fff">Apartments<br>{{ number_format($apartments) }}</h4>
			</div>
		</div>
	</div>



			@foreach($current_leases as $lease)
				@if($lease->openBalance() != 0)
					<a href="{{ route('apartments.lease.show',['name' => $lease->apartment->name, 'id' => $lease->id]) }} ">{{ $lease->apartment->name }} - Balance due: ${{ number_format($lease->openBalance(),2) }}</a>
					(Paid: 
					@foreach($lease->tenants as $t)
						 {{ $t->lastname . ': $' . number_format($t->payments()->where('payment_type','Rent')->where('lease_id',$lease->id)->sum('amount'),2) }}
					@endforeach
					)
					<br>
				@endif
			@endforeach
@stop