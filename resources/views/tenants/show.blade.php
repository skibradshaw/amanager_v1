@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
<div class="row">
	<div class="small-6 columns">
		<ul class="vcard">
		  <li class="fn">{{ $tenant->fullname }}</li>
		  <li class="fn">{{ $tenant->phone }}</li>
		  <li class="email"><a href="mailto:{{ $tenant->email }}">{{ $tenant->email }}</a></li>
		</ul>		
	</div>
	<div class="small-6 columns">
		@foreach($tenant->leases as $lease)
			<h4>{{ $lease->apartment->property->name . " " . $lease->apartment->name . ": " . $lease->startdate->format('m/d/Y') . "-" . $lease->enddate->format('m/d/Y') }}</h4>
			<ul>
				@foreach($lease->payments()->where('tenant_id',$tenant->id)->get() as $payment)
					<li>{{ $payment->paid_date->format('m/d/Y') . " - " . number_format($payment->amount,2) }}</li>
				@endforeach
			</ul>
		@endforeach
	</div>
</div>
@stop