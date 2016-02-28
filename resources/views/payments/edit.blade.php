  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A-Manager' }}</h1>
@stop
@section('content')
	@if(isset($payment))
	{!! Form::model($payment,['route' => ['apartments.lease.payments.update','name' => $lease->apartment->name, 'lease' => $lease->id, 'payment' => $payment->id],'method' => 'put']) !!}
	@else
	{!! Form::open(['route' => ['apartments.lease.payments.store','name' => $lease->apartment->name, 'id' => $lease->id]]) !!}
	@endif
	{!! Form::hidden('lease_id',$lease->id) !!}

  <div class="row collapse">
    <div class="large-2 columns">
		{!! Form::label('tenant_id','Select a Tenant',['class' => 'inline']) !!}
    </div>
   <div class="large-4 columns left">
        {!! Form::select('tenant_id',$tenants,(isset($tenant->id)) ? $tenant->id : ((isset($payment->tenant->id)) ? $payment->tenant->id : null)) !!}
    </div>
  </div> 
  <div class="row collapse">
	    <div class="large-2 columns">
			{!! Form::label('paid_date','Payment Date',['class' => 'inline']) !!}
	    </div>   
	    <div class="large-2 columns left">
			{!! Form::text('paid_date',(isset($payment->paid_date)) ? $payment->paid_date->format('n/d/Y') : null,['id' => 'datepicker','placeholder' => 'mm/dd/yy', 'style' => 'position: relative; z-index: 100000;']) !!}	      
	    </div>
   </div>
  <div class="row collapse">
	    <div class="large-2 columns">
			{!! Form::label('payment_type','Payment Type',['class' => 'inline']) !!}
	    </div>   
	    <div class="large-4 columns left">
	        {!! Form::select('payment_type',['Rent' => 'Rent', 'Fee' => 'Fee', 'Deposit' => 'Deposit'], (isset($payment_type)) ? $payment_type : $payment->payment_type) !!}
	    </div>
   </div>
  <div class="row collapse">
	    <div class="large-2 columns">
			{!! Form::label('amount','Amount',['class' => 'inline']) !!}
	    </div>
       <div class="small-1 columns">
          <span class="prefix">$</span>
        </div>	    
	   <div class="large-3 columns left">
	        {!! Form::text('amount') !!}
	    </div>
	    <div class="large-2 columns left">{!! $errors->first('amount','<span class="label alert radius">:message</span>') !!}</div>
   </div>
  <div class="row collapse">
	    <div class="large-2 columns">
			{!! Form::label('method','Method',['class' => 'inline']) !!}
	    </div>   
	    <div class="large-4 columns left">
	        {!! Form::select('method',['Cash' => 'Cash', 'Check' => 'Check', 'Credit Card' => 'Credit Card'],'Check') !!}
	    </div>
   </div>
  <div class="row collapse">
	    <div class="large-2 columns">
			{!! Form::label('check_no','Check #',['class' => 'inline']) !!}
	    </div>   
	    <div class="large-1 columns left">
	        {!! Form::text('check_no') !!}
	    </div>
   </div>

  <div class="row collapse">
	    <div class="large-2 columns">
			{!! Form::label('memo','Note',['class' => 'inline']) !!}
	    </div>   
	    <div class="large-4 columns left">
	        {!! Form::text('memo',(isset($tenant->leases()->where('leases.id',$lease->id)->first()->pivot->sublessor_name)) ? 'Currently subleased to: ' . $tenant->leases()->where('leases.id',$lease->id)->first()->pivot->sublessor_name : null) !!}
	    </div>
   </div>
 
   <button type="submit" class="radius button">Record Payment</button> or <a href="{{ URL::previous() }}">Go Back ></a>
	
  {!! Form::close() !!}


@stop
@section('scripts')
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });

  </script>
@stop