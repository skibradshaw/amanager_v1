<!doctype html>
<html class="no-js" lang="en">
	
	@include('inc.head')
  
  <body>
	@include('inc.header')  
  	<div class="row">
	  	<div class="large-4 large-centered columns">
		  	<h2>A Manager Login</h2>
	  	</div>
  	</div>
	  	
  	<div class="row" style="vertical-align: middle">
     
         
        <div class="large-4 large-centered columns">
			<form method="POST" action="/login">
			    {!! csrf_field() !!}
			
			    <div>
			        Email
			        <input type="email" name="email" value="{{ old('email') }}">
			    </div>
			
			    <div>
			        Password
			        <input type="password" name="password" id="password">
			    </div>
			
			    <div>
			        <input type="checkbox" name="remember"> Remember Me
			    </div>
			
			    <div>
			        <button type="submit" class="radius button">Login</button>
			    </div>
			</form> 
        </div>
  	</div>
  </body>

</html>



