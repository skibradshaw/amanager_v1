     <nav class="top-bar" data-topbar>
        <ul class="title-area">
           
          <li class="name">
            <h1>
              <a href="/">
               <img src="/img/logo.png">
              </a>
            </h1>
          </li>
          <li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
        </ul>
     
        <section class="top-bar-section">
          <ul class="left">
            @if(!empty($rents_due) && $rents_due <> 0)
            <li><a href="http://foundation.zurb.com/docs" style="background-color: #f04124"><i class="fa fa-usd" style="color:#fff"></i> Rents Due: ${{ number_format($rents_due,2)}}</a>
            </li>
            @endif
            @if(!empty($deposits_due) && $deposits_due <> 0)
            <li>
              <a href="http://foundation.zurb.com/docs" style="background-color: #f08a24"><i class="fa fa-lock" style="color:#fff"></i> Deposits Due: ${{ number_format($deposits_due,2)}}</a>
            </li>  
            @endif        
          </ul> 
          <ul class="right">
            @if(Auth::check())
            <li><a href="/apartments">Apartments</a></li>
            <li class="divider"></li>
            <li><a href="/tenants">Tenants</a></li>
            <li class="divider"></li>
            @if(!empty($undepositedfunds) && $undepositedfunds <> 0)
            <li><a href="/deposits/undeposited" style="background-color: #43AC6A">Undeposited Funds (${{ number_format($undepositedfunds,2)}})</a></li>
            @else
            <li><a href="/deposits/undeposited">Undeposited Funds</a></li>
            @endif
            <li class="divider"></li>
            <li><a href="/deposits">Deposits</a></li>
<!--             <li class="has-dropdown">
              <a href="#">Navigation</a>
              <ul class="dropdown">
                
                
                
                
              </ul>
            </li>
 -->
	        <li class="divider"></li>
            <li><a href="#">{{ Auth::user()->fullname }}</a></li>
            <li class="divider"></li>
            <li><a href="/logout">Logout</a></li>
            @else
            <li><a href="/login">Login</a></li>
            @endif
            
<!--

            
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
-->
          </ul>
        </section>
      </nav>