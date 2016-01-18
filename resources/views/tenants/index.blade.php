  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	<p><a href="/tenants/create" class="button radius">Add a Tenant</a></p>
	@foreach($tenants as $tenant)
		<a href="/tenants/{{ $tenant->id }}">{{ $tenant->firstname . " " . $tenant->lastname }}</a><br>
	@endforeach
@stop