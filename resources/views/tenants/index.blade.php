  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	@foreach($tenants as $tenant)
		<a href="/tenants/{{ $tenant->id }}/edit">{{ $tenant->firstname . " " . $tenant->lastname }}</a><br>
	@endforeach
@stop