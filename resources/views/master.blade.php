<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>{{ $title }}</title>

    <!-- Foundation core CSS -->
	{{-- Link to compiled, minimized and versioned css file. --}}
	<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">    



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <!--- <body style="background-image: url('/img/background.jpg'); background-repeat:no-repeat; background-position: center; "> -->
  <!--- FOUNDATION Template: Contact Page Template http://foundation.zurb.com/templates.html -->
<body>
  
  	


<!-- TODO Move to NAV and include  -->
      <nav class="top-bar" data-topbar>
        <ul class="title-area">
           
          <li class="name">
            <h1>
              <a href="#">
                Top Bar Title
              </a>
            </h1>
          </li>
          <li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
        </ul>
     
        <section class="top-bar-section">
           
          <ul class="right">
            <li class="divider"></li>
            <li class="has-dropdown">
              <a href="#">Main Item 1</a>
              <ul class="dropdown">
                <li><label>Section Name</label></li>
                <li class="has-dropdown">
                  <a href="#" class="">Has Dropdown, Level 1</a>
                  <ul class="dropdown">
                    <li><a href="#">Dropdown Options</a></li>
                    <li><a href="#">Dropdown Options</a></li>
                    <li><a href="#">Level 2</a></li>
                    <li><a href="#">Subdropdown Option</a></li>
                    <li><a href="#">Subdropdown Option</a></li>
                    <li><a href="#">Subdropdown Option</a></li>
                  </ul>
                </li>
                <li><a href="#">Dropdown Option</a></li>
                <li><a href="#">Dropdown Option</a></li>
                <li class="divider"></li>
                <li><label>Section Name</label></li>
                <li><a href="#">Dropdown Option</a></li>
                <li><a href="#">Dropdown Option</a></li>
                <li><a href="#">Dropdown Option</a></li>
                <li class="divider"></li>
                <li><a href="#">See all →</a></li>
              </ul>
            </li>
            <li class="divider"></li>
            <li><a href="#">Main Item 2</a></li>
            <li class="divider"></li>
            <li class="has-dropdown">
              <a href="#">Main Item 3</a>
              <ul class="dropdown">
                <li><a href="#">Dropdown Option</a></li>
                <li><a href="#">Dropdown Option</a></li>
                <li><a href="#">Dropdown Option</a></li>
                <li class="divider"></li>
                <li><a href="#">See all →</a></li>
              </ul>
            </li>
          </ul>
        </section>
      </nav>
     
       
     
     
       
     
      <div class="row">
     
         
        <div class="large-9 columns">
	    @if(Session::has('error'))
	        <div class="alert alert-warning">{{Session::get('error')}}</div>
	    @endif	  	
		@yield('header')    

        @yield('content')
     
          <div class="section-container tabs" data-section>
            <section class="section">
              <h5 class="title"><a href="#panel1">Contact Our Company</a></h5>
              <div class="content" data-slug="panel1">
                <form>
                  <div class="row collapse">
                    <div class="large-2 columns">
                      <label class="inline">Your Name</label>
                    </div>
                    <div class="large-10 columns">
                      <input type="text" id="yourName" placeholder="Jane Smith">
                    </div>
                  </div>
                  <div class="row collapse">
                    <div class="large-2 columns">
                      <label class="inline"> Your Email</label>
                    </div>
                    <div class="large-10 columns">
                      <input type="text" id="yourEmail" placeholder="jane@smithco.com">
                    </div>
                  </div>
                  <label>What's up?</label>
                  <textarea rows="4"></textarea>
                  <button type="submit" class="radius button">Submit</button>
                </form>
              </div>
            </section>
            <section class="section">
              <h5 class="title"><a href="#panel2">Specific Person</a></h5>
              <div class="content" data-slug="panel2">
                <ul class="large-block-grid-5">
                  <li><a href="/cdn-cgi/l/email-protection#81ece0edc1f2e4f3e4efe8f5f8afe3e2aff3e4e3"><img src="http://placehold.it/200x200&text=[person]">Mal Reynolds</a></li>
                  <li><a href="/cdn-cgi/l/email-protection#63190c0623100611060d0a171a4d01004d110601"><img src="http://placehold.it/200x200&text=[person]">Zoe Washburne</a></li>
                  <li><a href="/cdn-cgi/l/email-protection#2f454e56414a6f5c4a5d4a41465b56014d4c015d4a4d"><img src="http://placehold.it/200x200&text=[person]">Jayne Cobb</a></li>
                  <li><a href="/cdn-cgi/l/email-protection#2b4f44486b584e594e45425f5205494805594e49"><img src="http://placehold.it/200x200&text=[person]">Simon Tam</a></li>
                  <li><a href="/cdn-cgi/l/email-protection#9ff4f6f3f3e6f0eae8f6ebf7f2e6f2f6f1fbdfecfaedfaf1f6ebe6b1fdfcb1edfafd"><img src="http://placehold.it/200x200&text=[person]">River Tam</a></li>
                  <li><a href="/cdn-cgi/l/email-protection#95f9f0f4f3fafbe1fdf0e2fcfbf1d5e6f0e7f0fbfce1ecbbf7f6bbe7f0f7"><img src="http://placehold.it/200x200&text=[person]">Hoban Washburne</a></li>
                  <li><a href="/cdn-cgi/l/email-protection#fa98959591ba899f889f94938e83d49899d4889f98"><img src="http://placehold.it/200x200&text=[person]">Shepherd Book</a></li>
                  <li><a href="/cdn-cgi/l/email-protection#056e69606045766077606b6c717c2b67662b776067"><img src="http://placehold.it/200x200&text=[person]">Kaywinnet Lee Fry</a></li>
                  <li><a href="/cdn-cgi/l/email-protection#d2bbbcb3a0b392b5a7bbbeb6fcb1bdbfa2fcb3bebe"><img src="http://placehold.it/200x200&text=[person]">Inarra Serra</a></li>
                </ul>
              </div>
            </section>
          </div>
        </div>
     
         
     
     
         
     
     
        <div class="large-3 columns">
          <h5>Map</h5>
           
          <p>
            <a href="" data-reveal-id="mapModal"><img src="http://placehold.it/400x280"></a><br/>
            <a href="" data-reveal-id="mapModal">View Map</a>
          </p>
          <p>
            123 Awesome St.<br/>
            Barsoom, MA 95155
          </p>
        </div>
         
      </div>
     
       
     
     
       
     
      <footer class="row">
        <div class="large-12 columns">
          <hr/>
          <div class="row">
            <div class="large-6 columns">
              <p>© Copyright no one at all. Go to town.</p>
            </div>
            <div class="large-6 columns">
              <ul class="inline-list right">
                <li><a href="#">Link 1</a></li>
                <li><a href="#">Link 2</a></li>
                <li><a href="#">Link 3</a></li>
                <li><a href="#">Link 4</a></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
     
       
     
     
     
       
     
      <div class="reveal-modal" id="mapModal">
        <h4>Where We Are</h4>
        <p><img src="http://placehold.it/800x600"/></p>
     
         
        <a href="#" class="close-reveal-modal">×</a>
      </div>













    <!-- Foundation core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- JQuery Files -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> 
	
	<!-- Foundation Javascript Files -->
	<script src="{{ URL::asset('js/foundation.min.js') }}"></script>
	<script src="{{ URL::asset('js/all.js') }}"></script>

	<!-- DataTables -->
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script>
	$(document).foundation();
	</script>
	<script>
	$(function() {
	$( ".datepicker" ).datepicker();
	});
	</script>

    @yield('scripts')

  </body>
</html>

