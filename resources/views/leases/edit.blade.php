  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
@extends('app')
@section('header')
<h1>{{ $title or 'A Manager' }}</h1>
@stop
@section('content')
	@if(isset($lease))
		{!! Form::model($lease,['route' => ['apartments.lease.update','id' => $lease->id],'method' => 'update']) !!}
	@else
		{!! Form::open(['route' => ['apartments.lease.store',$apartment->name]]) !!}
	@endif
	{!! Form::hidden('apartment_id',$apartment->id) !!}
	<div class="row collapse">
		<div class="row">
			<div class="small-1 columns">
				{!! Form::label('startdate','Start:',['class' => 'inline']) !!} 
			</div>
			<div class="small-2 columns left">
				{!! Form::text('startdate',null,['id' => 'datepicker','placeholder' => 'mm/dd/yyyy', 'style' => 'position: relative; z-index: 100000;']) !!}
			</div>
			<div class="small-1 columns">
				{!! Form::label('enddate','End:',['class' => 'inline']) !!} 
			</div>			
			<div class="small-2 columns end">
				
				{!! Form::text('enddate',null,['id' => 'datepicker1','placeholder' => 'mm/dd/yyyy', 'style' => 'position: relative; z-index: 100000;']) !!}
			</div>
			<div class="small-6 columns">
				 {!! $errors->first('startdate','<span class="label alert radius">:message</span>') !!}
				 {!! $errors->first('enddate','<span class="label alert radius">:message</span>') !!}
			</div>	
		</div>
		<div class="row collapse">
			
			<div class="small-2 columns">
				{!! Form::label('monthly_rent','Monthly Rent: ') !!}
			</div>
	       <div class="small-1 columns">
	          <span class="prefix">$</span>
	        </div>	    
			<div class="small-2 columns end">
				{!! Form::text('monthly_rent') !!}
			</div>
			<div class="small-7 columns end">
				{!! $errors->first('monthly_rent','<span class="label alert radius">:message</span>') !!}
			</div>

		</div>
		<div class="row collapse">
			<div class="small-2 columns">
				{!! Form::label('pet_rent','Pet Rent: ') !!}
			</div>
	       <div class="small-1 columns">
	          <span class="prefix">$</span>
	        </div>	    
			<div class="small-2 columns end">
				{!! Form::text('pet_rent') !!}
			</div>
			<div class="small-7 columns end">
				{!! $errors->first('pet_rent','<span class="label alert radius">:message</span>') !!}
			</div>
		</div>
		<div class="row collapse">
			<div class="small-2 columns">
				{!! Form::label('deposit','Deposit Amount: ') !!}
			</div>
	       <div class="small-1 columns">
	          <span class="prefix">$</span>
	        </div>	    

			<div class="small-2 columns end">
				{!! Form::text('deposit') !!}
			</div>
			<div class="small-7 columns end">
				{!! $errors->first('deposit','<span class="label alert radius">:message</span>') !!}
			</div>

		</div>
		<div class="row collapse">
			<div class="small-2 columns">
				{!! Form::label('pet_deposit','Pet Deposit: ') !!}
			</div>
	       <div class="small-1 columns">
	          <span class="prefix">$</span>
	        </div>	    

			<div class="small-2 columns end">
				{!! Form::text('pet_deposit') !!}
			</div>
			<div class="small-7 columns end">
				{!! $errors->first('pet_deposit','<span class="label alert radius">:message</span>') !!}
			</div>
		</div>

	</div>
	
	@if(isset($lease))
		<button type="submit" class="radius button">Update</button>
		
	@else
		<button type="submit" class="radius button">Save</button>
	@endif	
	
	{!! Form::close() !!}

@stop

@section('scripts')
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({
        dateFormat: "mm/dd/yy",
        onSelect: function(dateText, instance) {
            date = $.datepicker.parseDate(instance.settings.dateFormat, dateText, instance.settings);
            date.setMonth(date.getMonth() + 12);
            date.setDate(date.getDate() - 1);
            $("#datepicker1").datepicker("setDate", date);
        }
    });
    $( "#datepicker1" ).datepicker();
  
  });


  </script>
@stop