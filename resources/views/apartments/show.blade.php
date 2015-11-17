  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	<h3 class="small">Leases</h3>
	@foreach($apartment->leases as $lease)
		<hr/>
		<h4 class="subheader"><a href="{{ route('apartments.lease.show',['name' => $apartment->name, 'id' => $lease->id]) }}">{{ $lease->startdate->format('n/j/Y') }} - {{ $lease->enddate->format('n/j/Y') }} - ${{ number_format($lease->monthly_rent,2) }} / mo</a></h4>
			@foreach($lease->tenants as $tenant)
	    	<ul class="vcard">
		    	<li class="fn">{{ $tenant->firstname }} {{ $tenant->lastname }}</li>
		    	<li class="phone">{{ $tenant->phone }}</li>
		    	<li class="email"><a href="mailto:{{ $tenant->email }}">{{ $tenant->email }}</a></li>
	    	</ul>			
	    	@endforeach
		
	@endforeach
@stop