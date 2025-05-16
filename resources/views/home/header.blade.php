<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="/home" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">HangOut</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/home#about">About</a></li>
          <li><a href="/home#menu">Menu</a></li>
          <li><a href="/show_orders">Orders</a></li>
          <li><a href="/home#gallery">Gallery</a></li>
          
        
          <li><a href="#contact">Contact</a></li>
          
          @if (Route::has('login'))

          @auth
          <li><a class="btn-getstarted" href="{{url('my_cart')}}"><b>Cart</b></a></li>
          <form action="{{route('logout')}}" method="post">
              @csrf
            <input class="btn-getstarted" type="submit" value="Logout">
          </form>
          @else
          <li><a class="btn-getstarted" href="{{route('login')}}"><b>Login</b></a></li>
          <li><a class="btn-getstarted" href="{{route('register')}}"><b>Register</b></a></li>
            @endauth
          @endif
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="index.html#book-a-table">Book a Table</a>

    </div>
  </header>