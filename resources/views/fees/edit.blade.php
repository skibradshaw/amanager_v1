  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	@if(isset($fee))
		{!! Form::model($fee,['route' => ['apartments.lease.fees.update','name' => $lease->apartment->name, 'id' => $lease->id], 'method' => 'Put'])  !!}
	@else
		{!! Form::open(['route' => ['apartments.lease.fees.store','name' => $lease->apartment->name, 'id' => $lease->id]]) !!}
	@endif
	
  <div class="row collapse">
    <div class="large-2 columns">
		{!! Form::label('item_name','Fee for:',['class' => 'inline']) !!}
    </div>
   <div class="large-4 columns left">
        {!! Form::select('item_name',$fees,'Late Fee') !!}
    </div>
  </div> 
  <div class="row collapse">
	    <div class="large-2 columns">
			{!! Form::label('due_date','Due Date:',['class' => 'inline']) !!}
	    </div>   
	    <div class="large-2 columns left">
			{!! Form::text('due_date',null,['id' => 'datepicker','placeholder' => 'mm/dd/yy', 'style' => 'position: relative; z-index: 100000;']) !!}	      
	    </div>
   </div>
  <div class="row collapse">
	    <div class="large-2 columns">
			{!! Form::label('amount','Amount:',['class' => 'inline']) !!}
	    </div>
       <div class="small-1 columns">
          <span class="prefix">$</span>
        </div>	    
	   <div class="small-2 columns left">
	        {!! Form::text('amount',number_format($lease->monthly_rent*.10,2)) !!}
	    </div>
	    <div class="small-1 columns left">
          <span class="postfix"><h5><small>(default 10%)</small></h5></span>
        </div>
   </div>
  <div class="row collapse">
	    <div class="large-2 columns">
			{!! Form::label('note','Notes:',['class' => 'inline']) !!}
	    </div>   
	    <div class="large-4 columns left">
			{!! Form::text('note') !!}	      
	    </div>
   </div>
	@if(isset($fee))
		<button type="submit" class="radius button">Edit Fee</button> or <a href="{{ URL::previous() }}">Go Back ></a>
	@else
		<button type="submit" class="radius button">Asses Fee</button>
	@endif	
  {!! Form::close() !!}
	

@stop
@section('scripts')
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });

  </script>
@stop