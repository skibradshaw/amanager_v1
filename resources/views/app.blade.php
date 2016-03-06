<!doctype html>
<html class="no-js" lang="en">
	
	@include('inc.head')
  
  <body>
  	@include('inc.header')

      <div class="row">
     
         
        <div class="large-12 columns">
        
	    @if(Session::has('error'))
	        <div data-alert class="alert-box alert radius">{{Session::get('error')}}</div>
	    @endif	  	
	    @if(Session::has('status'))
	        <div data-alert class="alert-box success radius">{{Session::get('status')}}</div>
	    @endif
		@yield('header')    

        @yield('content')
     
		@include('inc.foot')
        </div>
      </div>

<script type="text/javascript">
(function() {
var s = document.createElement("script");
s.type = "text/javascript";
s.async = true;
s.src = '//api.usersnap.com/load/'+
        'b3bb63b8-89ec-49df-ad29-a67532c736d1.js';
var x = document.getElementsByTagName('script')[0];
x.parentNode.insertBefore(s, x);
})();
</script>     
  </body>

</html>
