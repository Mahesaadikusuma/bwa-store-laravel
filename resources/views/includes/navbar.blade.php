<nav class="navbar navbar-expand-lg navbar-store fixed-top navbar-fixed-top bg-white" data-aos="fade-down">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><img src="images/logo.svg" alt="" /></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active me-3" aria-current="page" href="{{ route('home') }}">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link me-3" href="{{ route('categories') }}">Categories</a>
            </li>

            <li class="nav-item">
              <a class="nav-link  me-3" href="#">Rewards</a>
            </li>

            @guest
            <li class="nav-item">
              <a class="nav-link me-4" href="{{ route('register') }}">Sign up</a>
            </li>

            <li class="nav-item">
              <a class="nav-link btn btn-success px-4 text-white" href="{{ route('login') }}">Sign in</a>
            </li>
            @endguest

            
            
          </ul>

          @auth
          <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item dropdown mt-1">
              <a
                href="#"
                class="nav-link"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
              
                <img
                  src="/images/icon_user.png"
                  alt=""
                  class="rounded-circle mr-2 profile-picture"/>
                Hi, {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu">
                <a href="{{ route('dashboard') }}" class="dropdown-item">Dashboard</a>
                <a href="{{ route('dashboard-myAccount') }}" class="dropdown-item"
                  >Settings</a
                >
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
            <li class="nav-item">
              <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2 ">
                @php
                    $carts = \App\Cart::where('users_id', Auth::User()->id)->count();
                @endphp

                @if ($carts > 0)
                    <img src="/images/icon-cart-empty.svg" alt="" />
                    <div class="card-badge">{{ $carts }}</div>
                @else
                    <img src="/images/icon-cart-empty.svg" alt="" />
                @endif
                
              </a>
            </li>
          </ul>

          <ul class="navbar-nav d-block d-lg-none">
            <li class="nav-item">
              <a href="#" class="nav-link">
                Hi, {{ Auth::user()->name }}
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cart') }}" class="nav-link d-inline-block">
                Cart
              </a>
            </li>
          </ul>
          @endauth
        </div>
      </div>
    </nav>