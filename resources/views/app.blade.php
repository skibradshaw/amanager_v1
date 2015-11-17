<!doctype html>
<html class="no-js" lang="en">
	
	@include('inc.head')
  
  <body>
  	@include('inc.header')

      <div class="row">
     
         
        <div class="large-12 columns">
	    @if(Session::has('error'))
	        <div data-alert class="alert-box warning radius">{{Session::get('error')}}</div>
	    @endif	  	
	    @if(Session::has('status'))
	        <div data-alert class="alert-box success radius">{{Session::get('status')}}</div>
	    @endif
		@yield('header')    

        @yield('content')
     
		@include('inc.foot')
        </div>
      </div>

     
  </body>

</html>
