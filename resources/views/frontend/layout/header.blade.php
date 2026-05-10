<!-- Header Section Begin -->
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('template-landing/img/logo.png') }}" alt="Parfum Toko" /></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="{{ request()->routeIs('shop') ? 'active' : '' }}">
                            <a href="{{ route('shop') }}">Shop</a>
                        </li>
                        @auth
                        <li class="{{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                            <a href="{{ route('transactions.index') }}">Pesanan Saya</a>
                        </li>
                        @endauth
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <div class="header__right__auth">
                        @guest
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Register</a>
                        @endguest
                        @auth
                            <a href="{{ route('transactions.index') }}">{{ Auth::user()->name }}</a>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                                Logout
                            </a>
                            <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display:none;">
                                @csrf
                            </form>
                        @endauth
                    </div>
                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        <li>
                            <a href="{{ route('cart.index') }}">
                                <span class="icon_bag_alt"></span>
                                @auth
                                    @php
                                        $cartCount = auth()->user()->cart
                                            ? auth()->user()->cart->items->sum('qty')
                                            : 0;
                                    @endphp
                                    @if($cartCount > 0)
                                        <div class="tip">{{ $cartCount }}</div>
                                    @endif
                                @endauth
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->