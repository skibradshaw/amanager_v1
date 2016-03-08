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
          @if(Auth::check())
          <ul class="left">

            @if(!empty($rents_due) && $rents_due <> 0)
            <li class="has-dropdown"><a href="#" style="background-color: #f04124"><i class="fa fa-usd" style="color:#fff"></i> Rents Due: ${{ number_format($rents_due,2)}}</a>
              <ul class="dropdown">
                  @foreach($properties as $property)
                  <li><a href="{{ route('reports.rentsdue',['id' => $property->id]) }}">{{$property->name}} - {{number_format($property->rentBalance(),2)}} </a></li>
                  <li class="divider"></li>
                  @endforeach
              </ul>
            </li>
            @endif
            @if(!empty($deposits_due) && $deposits_due <> 0)
            <li class="has-dropdown">
              <a href="#" style="background-color: #f08a24"><i class="fa fa-lock" style="color:#fff"></i> Deposits Due: ${{ number_format($deposits_due,2)}}</a>
              <ul class="dropdown">
                  @foreach($properties as $property)
                  <li><a href="{{route('reports.depositsdue',['id' => $property->id])}}">{{$property->name}} - {{number_format($property->depositBalance(),2)}} </a></li>
                  <li class="divider"></li>
                  @endforeach
              </ul>              
            </li>  
            @endif        
          </ul> 
          <ul class="right">
            <li class="has-dropdown"><a href="#">Apartments</a>
              <ul class="dropdown">
                  @foreach($properties as $property)
                  <li><a href="{{route('properties.apartments.index',['id' => $property->id])}}">{{$property->name}}</a></li>
                  <li class="divider"></li>
                  @endforeach
              </ul>
            </li>
            <li class="divider"></li>
            <li><a href="/tenants">Tenants</a></li>
            <li class="divider"></li>
            @if(!empty($undepositedfunds) && $undepositedfunds <> 0)
             <li class="has-dropdown"><a href="#" style="background-color: #43AC6A">Undeposited Funds (${{ number_format($undepositedfunds,2)}})</a>
            @else
            <li class="has-dropdown"><a href="#">Undeposited Funds</a>
            @endif
                <ul class="dropdown">
                  @foreach($properties as $property)
                  <li><a href="{{route('undeposited',['id' => $property->id])}}">{{$property->name}}: ${{number_format($property->undeposited(),0)}} </a></li>
                  <li class="divider"></li>
                  @endforeach                  
                </ul>
             </li>
            <li class="divider"></li>
            <li class="has-dropdown"><a href="#">Bank Deposits</a>
                <ul class="dropdown">
                  @foreach($properties as $property)
                  <li><a href="{{route('properties.deposits.index',['id' => $property->id])}}">{{$property->name}}</a></li>
                  <li class="divider"></li>
                  @endforeach                  
                </ul>
            </li>
<!--             <li class="has-dropdown">
              <a href="#">Navigation</a>
              <ul class="dropdown">
                
                
                
                
              </ul>
            </li>
 -->
	        <li class="divider"></li>

            <li class="has-dropdown" style="background-color: ##008CBA"><a href="#">{{ Auth::user()->fullname }}</a>
              <ul class="dropdown">
                <li><a href="/logout">Logout</a></li>
              </ul>
            </li>
          </ul>
            @else
            <ul class="right">
            <li><a href="/login">Login</a></li>
            </ul>
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