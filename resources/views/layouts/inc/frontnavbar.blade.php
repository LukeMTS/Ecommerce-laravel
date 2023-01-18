<nav class="navbar navbar-expand-lg bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">E-Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('category') }}">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('cart') }}">Cart
            <span class="badge bagde-pill bg-primary cart-count">0</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('wishlist') }}">Wishlist
            <span class="badge bagde-pill bg-success wishlist-count">0</span>
          </a>
        </li>
        @guest
          @if (Route::has('login'))
            <li>
              <a class="nav-link" href="{{ route('login') }}">{{ __('login') }}</a>
            </li>
          @endif
          @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">
                {{ __('register') }}
              </a>
            </li>
          @endif
        @else
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li>  
              <a class="dropdown-item" href="{{ url('my-orders') }}">
                My Orders
              </a>
            </li>
           <li>  
              <a class="dropdown-item" href="#">
                My Profile
              </a>
            </li>
            <li class="nav-item">
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>
          </ul>
        </li>
      @endguest
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>