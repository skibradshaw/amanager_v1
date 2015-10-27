  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
<p><a href="apartments/create" class="button">Create a New Apartment</a></p>
@foreach($apartments as $apt)
 	<a href="/apartments/{{$apt->id}}/edit">{{ $apt->property->abbreviation . ' ' . $apt->number }}</a><br>
@endforeach
@stop