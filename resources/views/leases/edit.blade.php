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
			<div class="medium-6 columns">
				 {!! $errors->first('startdate','<span class="label alert radius">:message</span>') !!}
			</div>	
		</div>
		<div class="row collapse">
		    <div class="small-3 large-2 columns">
		      <span class="prefix">{!! Form::label('startdate','Lease Start:',['class' => 'inline']) !!}</span>
		    </div>
		    <div class="small-4 large-2 end columns">
		      {!! Form::text('startdate',null,['id' => 'datepicker','placeholder' => 'mm/dd/yyyy', 'style' => 'position: relative; z-index: 100000;']) !!}
		    </div>
		</div>
		<div class="row collapse">
			<div class="medium-6 columns">
				 {!! $errors->first('enddate','<span class="label alert radius">:message</span>') !!}
			</div>	
		</div>
		<div class="row collapse">
		    <div class="small-3 large-2 columns">
		      <span class="prefix">{!! Form::label('enddate','Lease End:',['class' => 'inline']) !!}</span>
		    </div>
		    <div class="small-4 large-2 end columns">
		     {!! Form::text('enddate',null,['id' => 'datepicker1','placeholder' => 'mm/dd/yyyy', 'style' => 'position: relative; z-index: 100000;']) !!}
		    </div>		
		</div>
		<div class="row collapse">
			<div class="medium-6 columns">
				 {!! $errors->first('monthly_rent','<span class="label alert radius">:message</span>') !!}
			</div>	
		</div>
		    
		<div class="row">
		    <div class="small-3 large-2 columns">
		      {!! Form::label('monthly_rent','Monthly Rent:',['class' => 'inline']) !!}
		    </div>
		    <div class="small-4 large-2 columns end">
		    	<div class="row collapse">
			       <div class="small-3 columns">
			          <span class="prefix">$</span>
			       </div>
			       <div class="small-9 columns end">
			       	  {!! Form::text('monthly_rent') !!}
			       </div>	 		    		
		    	</div>		      
		    </div>
		</div>
		<div class="row collapse">
			<div class="medium-6 columns">
				 {!! $errors->first('pet_rent','<span class="label alert radius">:message</span>') !!}
			</div>	
		</div>
		<div class="row">
		    <div class="small-3 large-2 columns">
		      {!! Form::label('pet_rent','Pet Rent:',['class' => 'inline']) !!}
		    </div>
		    <div class="small-4 large-2 columns end">
		    	<div class="row collapse">
			       <div class="small-3 columns">
			          <span class="prefix">$</span>
			       </div>
			       <div class="small-9 columns end">
			       	  {!! Form::text('pet_rent') !!}
			       </div>	 		    		
		    	</div>		      
		    </div>
		</div>
		<div class="row collapse">
			<div class="medium-6 columns">
				 {!! $errors->first('deposit','<span class="label alert radius">:message</span>') !!}
			</div>	
		</div>
		<div class="row">
		    <div class="small-3 large-2 columns">
		      {!! Form::label('deposit','Deposit Amount:',['class' => 'inline']) !!}
		    </div>
		    <div class="small-4 large-2 columns end">
		    	<div class="row collapse">
			       <div class="small-3 columns">
			          <span class="prefix">$</span>
			       </div>
			       <div class="small-9 columns end">
			       	  {!! Form::text('deposit') !!}
			       </div>	 		    		
		    	</div>		      
		    </div>
		</div>
		<div class="row collapse">
			<div class="medium-6 columns">
				 {!! $errors->first('pet_deposit','<span class="label alert radius">:message</span>') !!}
			</div>	
		</div>
		<div class="row">
		    <div class="small-3 large-2 columns">
		      {!! Form::label('pet_deposit','Pet Deposit:',['class' => 'inline']) !!}
		    </div>
		    <div class="small-4 large-2 columns end">
		    	<div class="row collapse">
			       <div class="small-3 columns">
			          <span class="prefix">$</span>
			       </div>
			       <div class="small-9 columns end">
			       	  {!! Form::text('pet_deposit') !!}
			       </div>	 		    		
		    	</div>		      
		    </div>
		</div>	
	@if(isset($lease))
		<button type="submit" class="radius button">Update</button>
		
	@else
		<button type="submit" class="radius button">Save</button>
	@endif	
	
	{!! Form::close() !!}
<hr>
	<h3 class="small">Existing Leases</h3>
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