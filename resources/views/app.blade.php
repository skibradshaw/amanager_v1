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

<script type='text/javascript'>
(function (d, t) {
  var bh = d.createElement(t), s = d.getElementsByTagName(t)[0];
  bh.type = 'text/javascript';
  bh.src = 'https://www.bugherd.com/sidebarv2.js?apikey=tzc9ltqbygv5fszegctogq';
  s.parentNode.insertBefore(bh, s);
  })(document, 'script');
</script>   
  </body>

</html>
