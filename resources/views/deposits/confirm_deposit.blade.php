  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	{!! Form::open(['route' => ['properties.deposits.store',$property->id],'mehtod' => 'Post']) !!}
	<div class="row collapse">
		<div class="large-2 columns">
			{!! Form::label('bank_account_id','Choose Account',['class' => 'inline']) !!}
		</div>
		<div class="large-4 columns left">
		    {!! Form::select('bank_account_id',['1' => 'Setup Bank 1','2' => 'Setup Bank 2'],1) !!}
		</div>
	</div> 
	<div class="row collapse">
	    <div class="large-2 columns">
			{!! Form::label('deposit_date','Date',['class' => 'inline']) !!}
	    </div>   
	    <div class="large-2 columns left">
			{!! Form::text('deposit_date',\Carbon\Carbon::now()->format('n/j/Y'),['id' => 'datepicker','style' => 'position: relative; z-index: 100000;']) !!}	      
	    </div>
	</div>
	<div class="row collapse">
		<div class="large-2 columns">
			<h3>Total Deposit</h3>
		</div>   
		<div class="large-2 columns left">
			<h3>${{number_format($total,2) }} {!! Form::hidden('amount',$total) !!}</h3>
		</div>
	</div>
	<button type="submit" class="radius button">Record Deposit</button>
	@foreach($payments as $p)
		{!! Form::hidden('payment_id[]',$p->id) !!}
	@endforeach
	{!! Form::close() !!}
@stop
@section('scripts')
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });

  </script>
@stop