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
           
          <ul class="right">
            @if(Auth::check())
            <li class="has-dropdown">
              <a href="#">Navigation</a>
              <ul class="dropdown">
                <li><a href="/apartments">Apartments</a></li>
                <li><a href="/tenants">Tenants</a></li>
                <li><a href="/deposits/undeposited">Undeposited Funds</a></li>
                <li class="divider"></li>
                <li><label>Current Leases</label></li>
                <li><a href="#">Dropdown Option</a></li>
                <li><a href="#">Dropdown Option</a></li>
                <li><a href="#">Dropdown Option</a></li>
                <li class="divider"></li>
                <li><a href="#">See all →</a></li>
              </ul>
            </li>
	        <li class="divider"></li>
	        
            <li><a href="#">{{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}</a></li>
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