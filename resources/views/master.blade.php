<!DOCTYPE html>
<html lang="en">


  <!--- <body style="background-image: url('/img/background.jpg'); background-repeat:no-repeat; background-position: center; "> -->

<body>
  
  	


<!-- TODO Move to NAV and include  -->
 
     
       
     
     
       
     
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
     
       
     
     
       
     
     
       
     
     
     
       
     
      <div class="reveal-modal" id="mapModal">
        <h4>Where We Are</h4>
        <p><img src="http://placehold.it/800x600"/></p>
     
         
        <a href="#" class="close-reveal-modal">×</a>
      </div>













  </body>
</html>

