<!doctype html>
<html class="no-js" lang="en">
	
	@include('inc.head')
  
  <body>
  	@include('inc.header')

      <div class="row">
     
         
        <div class="large-9 columns">
	    @if(Session::has('error'))
	        <div class="alert alert-warning">{{Session::get('error')}}</div>
	    @endif	  	
		@yield('header')    

        @yield('content')
     
 
        </div>
  	@include('inc.foot')
  </body>

</html>