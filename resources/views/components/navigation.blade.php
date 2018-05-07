<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">~GinTonic~</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fa fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            @foreach($nav_links as $nav_link)
              <li class="nav-item">
                <a class="nav-link" href="{{route($nav_link->route_name)}}">
                  {{$nav_link->text }}
                </a>
              </li>
            @endforeach 
            
            @if(session()->has('user'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('poll') }}">Poll</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">Logout</a>
              </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{route('loginForm') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('registerForm') }}">Register</a>
            </li>
            
            @endif
        </ul>
      </div>
    </div>
  </nav>