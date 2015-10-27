  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
<p><a href="apartments/create" class="button">Create a New Apartment</a></p>
@foreach($apartments as $apt)
 	<a href="/apartments/{{$apt->name}}/edit">{{ $apt->property->abbreviation . ' ' . $apt->number }}</a> - <a href="{{ route('apartments.lease.create',['name' => $apt->name]) }}">Create a Lease</a><br>
@endforeach
@stop