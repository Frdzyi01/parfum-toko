<!doctype html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="description" content="Parfum Toko - Toko Parfum Online" />
    <meta name="keywords" content="parfum, toko parfum, parfum online" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title', 'Parfum Toko')</title>

    <!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Cookie&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('template-landing/css/bootstrap.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('template-landing/css/font-awesome.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" type="text/css" />
    <link rel="stylesheet" href="{{ asset('template-landing/css/elegant-icons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('template-landing/css/jquery-ui.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('template-landing/css/magnific-popup.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('template-landing/css/owl.carousel.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('template-landing/css/slicknav.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('template-landing/css/style.css') }}" type="text/css" />
  </head>

  <body>
    <!-- Page Preloder -->
    <div id="preloder">
      <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
      <div class="offcanvas__close">+</div>
      <ul class="offcanvas__widget">
        <li><span class="icon_search search-switch"></span></li>
        <li>
          <a href="{{ route('cart.index') }}">
            <span class="icon_bag_alt"></span>
            @auth
              @php $cartCount = auth()->user()->cart ? auth()->user()->cart->items->sum('qty') : 0; @endphp
              @if($cartCount > 0)
                <div class="tip">{{ $cartCount }}</div>
              @endif
            @endauth
          </a>
        </li>
      </ul>
      <div class="offcanvas__logo">
        <a href="{{ route('home') }}"><img src="{{ asset('template-landing/img/logo.png') }}" alt="Parfum Toko" /></a>
      </div>
      <div id="mobile-menu-wrap"></div>
      <div class="offcanvas__auth">
        @guest
          <a href="{{ route('login') }}">Login</a>
          <a href="{{ route('register') }}">Register</a>
        @endguest
        @auth
          <a href="{{ route('transactions.index') }}">Pesanan Saya</a>
          <a href="{{ route('logout') }}"
             onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">Logout</a>
          <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
          </form>
        @endauth
      </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Flash Messages -->
    @if(session('success'))
      <div class="container" style="margin-top:15px;">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fa fa-check-circle"></i> {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
      </div>
    @endif
    @if(session('error'))
      <div class="container" style="margin-top:15px;">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
      </div>
    @endif

    @include('frontend.layout.header')

    @yield('content')

    @include('frontend.layout.footer')
