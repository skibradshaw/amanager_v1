<h3>Add Sublessor Name</h3>
	 {!! Form::open(['route' => 'tenants.add_sublease']) !!}
		{!! Form::label('sublessor_name','Sub-Lease Tenant Name:') !!}
		<input id="subleasetenant" name="sublessor_name" autofocus type="text" value="{{ $sublessor_name }}">
		{!! Form::hidden('tenant_id',$tenant->id,['id' => 'tenant_id']) !!}
		{!! Form::hidden('lease_id',$lease->id) !!}
		
		<button type="submit" id="add_sublease" class="radius button tiny" disabled>Add Sublease</button>
     {!! Form::close(['class' => 'close-reveal-modal']) !!} 	
	 <a class="close-reveal-modal" aria-label="Close">&#215;</a>

<script type="text/javascript">
$( document ).ready(function(){
    $('#subleasetenant').keyup(function() {

        var empty = false;
        if ($(this).val().length == 0) {
            empty = true;
        }

        if (empty) {
            $('#add_sublease').attr('disabled', 'disabled');
        } else {
            $('#add_sublease').removeAttr('disabled');
        }
    });	
});
</script>