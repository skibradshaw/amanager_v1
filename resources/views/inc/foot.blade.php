      <footer class="row">
        <div class="large-12 columns">
          <hr/>
          <div class="row">
            <div class="large-6 columns">
              <p>© {{ \Carbon\Carbon::now()->year }} A-Manager.</p>
            </div>
            <div class="large-6 columns">
<!--               <ul class="inline-list right">
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li><a href="#">Link 3</a></li>
                <li><a href="#">Link 4</a></li>
              </ul> -->
            </div>
          </div>
        </div>
      </footer>

	<!--     Universal Modals   -->
	  <div id="allocatePayment" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

	  </div>

	  <div id="choosePayment" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

	  </div>

	  <div id="changePetRent" class="reveal-modal medium" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

	  </div>

	  <div id="addSubLease" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

	  </div> 
	  
	  <div id="terminateLease" class="reveal-modal small" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

	  </div>
    <!-- Foundation core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- JQuery Files -->
	<script src="{{ URL::asset('js/all.js') }}"></script>

	<!-- Foundation Javascript Files -->
	<script src="{{ URL::asset('js/foundation.min.js') }}"></script>
	<script src="{{ URL::asset('js/modernizr.js') }}"></script>

	<script>
	$(document).foundation();
	</script>


		

    @yield('scripts')

	</script>
	    <script type="text/javascript">
	/*
			  (function() {
			  var s = document.createElement("script");
			    s.type = "text/javascript";
			    s.async = true;
			    s.src = '//api.usersnap.com/load/'+
			            'b4bd0fc5-8ba6-4a2f-83ea-88e1f3f774a3.js';
			    var x = document.getElementsByTagName('script')[0];
			    x.parentNode.insertBefore(s, x);
			  })();
	*/
	</script> 
