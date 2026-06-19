<!-- Header Section Begin -->
<style>
    /* CSS overrides for modern premium purple header */
    .header-custom {
        background-color: #632c9b !important;
        padding: 14px 0 !important;
        position: sticky;
        top: 0;
        z-index: 999;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
    }
    
    .header-custom .logo-container {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        outline: none;
    }
    
    .header-custom .logo-badge {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.85);
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        font-family: 'Cinzel', serif;
        font-weight: 700;
        font-size: 1.3rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        transition: transform 0.3s ease;
    }
    
    .header-custom .logo-container:hover .logo-badge {
        transform: rotate(360deg);
    }
    
    .header-custom .logo-text-main {
        font-family: 'Cinzel', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #ffffff;
        letter-spacing: 2px;
        line-height: 1;
    }
    
    .header-custom .logo-text-sub {
        font-family: 'Montserrat', sans-serif;
        font-size: 0.65rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.75);
        letter-spacing: 5px;
        margin-top: 3px;
        text-transform: uppercase;
    }
    
    /* Nav Menu */
    .header-custom .nav-menu {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }
    
    .header-custom .nav-menu ul {
        display: flex;
        list-style: none;
        gap: 30px;
        margin: 0;
        padding: 0;
    }
    
    .header-custom .nav-menu li {
        position: relative;
        padding: 8px 0;
    }
    
    .header-custom .nav-menu a {
        font-family: 'Inter', sans-serif;
        font-size: 0.92rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.85);
        text-decoration: none;
        transition: color 0.2s ease;
    }
    
    .header-custom .nav-menu a:hover {
        color: #ffffff;
    }
    
    .header-custom .nav-menu li.active a {
        color: #ffffff;
    }
    
    .header-custom .nav-menu li.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #ffffff;
        border-radius: 2px;
    }
    
    /* Search Bar */
    .header-custom .search-container {
        display: flex;
        align-items: center;
        height: 100%;
    }
    
    .header-custom .search-form {
        position: relative;
        width: 100%;
        max-width: 260px;
    }
    
    .header-custom .search-input {
        width: 100%;
        padding: 10px 45px 10px 18px;
        border-radius: 24px;
        border: 1.5px solid rgba(255, 255, 255, 0.15);
        background-color: rgba(255, 255, 255, 0.12);
        color: #ffffff;
        font-family: 'Inter', sans-serif;
        font-size: 0.88rem;
        outline: none;
        transition: all 0.2s ease;
    }
    
    .header-custom .search-input::placeholder {
        color: rgba(255, 255, 255, 0.65);
    }
    
    .header-custom .search-input:focus {
        background-color: #ffffff;
        color: #1e293b;
        border-color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    
    .header-custom .search-input:focus::placeholder {
        color: #94a3b8;
    }
    
    .header-custom .search-btn {
        position: absolute;
        right: 4px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: rgba(255, 255, 255, 0.7);
        cursor: pointer;
        padding: 8px 12px;
        transition: color 0.2s ease;
        outline: none;
    }
    
    .header-custom .search-input:focus + .search-btn {
        color: #632c9b;
    }
    
    .header-custom .search-btn:hover {
        color: #ffffff;
    }
    
    .header-custom .search-input:focus + .search-btn:hover {
        color: #522283;
    }
    
    /* Right Widgets */
    .header-custom .widgets-container {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 20px;
        height: 100%;
    }
    
    .header-custom .widget-link {
        color: rgba(255, 255, 255, 0.85);
        font-size: 1.2rem;
        position: relative;
        transition: color 0.2s, transform 0.2s;
        text-decoration: none;
        display: flex;
        align-items: center;
    }
    
    .header-custom .widget-link:hover {
        color: #ffffff;
        transform: translateY(-1px);
    }
    
    .header-custom .widget-link:active {
        transform: translateY(1px);
    }
    
    .header-custom .widget-badge {
        position: absolute;
        top: -8px;
        right: -10px;
        background-color: #ff3366;
        color: #ffffff;
        font-family: 'Inter', sans-serif;
        font-size: 0.68rem;
        font-weight: 700;
        min-width: 17px;
        height: 17px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1.5px solid #632c9b;
        padding: 0 4px;
    }
    
    /* User Profile Dropdown */
    .header-custom .user-dropdown-btn {
        color: rgba(255, 255, 255, 0.85);
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: 'Inter', sans-serif;
        font-size: 1.2rem;
        padding: 5px 0;
        transition: color 0.25s;
        outline: none;
    }
    
    .header-custom .user-dropdown-btn:hover {
        color: #ffffff;
    }
    
    .header-custom .dropdown-wrapper {
        position: relative;
    }
    
    .header-custom .dropdown-menu {
        position: absolute;
        top: calc(100% + 12px);
        right: 0;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
        min-width: 160px;
        padding: 8px 0;
        display: none;
        z-index: 100;
        animation: slideDown 0.2s ease-out;
    }

    .header-custom .dropdown-menu::before {
        content: '';
        position: absolute;
        top: -12px;
        left: 0;
        right: 0;
        height: 12px;
        background: transparent;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(6px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .header-custom .dropdown-item {
        display: block;
        padding: 10px 20px;
        color: #334155;
        text-decoration: none;
        font-size: 0.88rem;
        font-weight: 500;
        transition: background-color 0.2s, color 0.2s;
        font-family: 'Inter', sans-serif;
        text-align: left;
    }
    
    .header-custom .dropdown-item:hover {
        background-color: #f1f5f9;
        color: #632c9b;
    }
    
    .header-custom .dropdown-wrapper:hover .dropdown-menu {
        display: block;
    }
</style>

<header class="header-custom">
    <div class="container-fluid" style="max-width: 1280px; margin: 0 auto; padding: 0 25px;">
        <div class="row align-items-center">
            <!-- Logo Column -->
            <div class="col-xl-3 col-lg-3 col-md-4 col-8">
                <a href="{{ route('beranda') }}" class="logo-container">
                    <div class="logo-badge">R</div>
                    <div class="logo-text">
                        <div class="logo-text-main">RANDO</div>
                        <div class="logo-text-sub">PARFUM</div>
                    </div>
                </a>
            </div>
            
            <!-- Navigation Links Column -->
            <div class="col-xl-5 col-lg-5 d-none d-lg-block">
                <nav class="nav-menu">
                    <ul>
                        <li class="{{ request()->routeIs('beranda') ? 'active' : '' }}">
                            <a href="{{ route('beranda') }}">Beranda</a>
                        </li>
                        <li class="{{ request()->routeIs('toko') ? 'active' : '' }}">
                            <a href="{{ route('toko') }}">Katalog</a>
                        </li>
                        <li class="{{ request()->routeIs('cara-belanja') ? 'active' : '' }}">
                            <a href="{{ route('cara-belanja') }}">Cara Belanja</a>
                        </li>
                        <li class="{{ request()->routeIs('tentang-kami') ? 'active' : '' }}">
                            <a href="{{ route('tentang-kami') }}">Tentang Kami</a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <!-- Search & Actions Column -->
            <div class="col-xl-4 col-lg-4 col-md-8 col-4">
                <div class="widgets-container">
                    <!-- Search Input Form -->
                    <div class="search-container d-none d-md-block">
                        <form action="{{ route('toko') }}" method="GET" class="search-form">
                            <input type="text" name="cari" class="search-input" placeholder="Cari parfum..." value="{{ request('cari') }}">
                            <button type="submit" class="search-btn">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                    
                    <!-- Cart Link Widget -->
                    <a href="{{ route('keranjang.index') }}" class="widget-link" title="Keranjang Belanja">
                        <i class="fa-solid fa-cart-shopping"></i>
                        @auth
                            @php
                                $cartCount = auth()->user()->keranjang
                                    ? auth()->user()->keranjang->item->sum('jumlah')
                                    : 0;
                            @endphp
                            @if($cartCount > 0)
                                <div class="widget-badge">{{ $cartCount }}</div>
                            @endif
                        @endauth
                    </a>
                    
                    <!-- Transactions Link Widget -->
                    @auth
                    <a href="{{ route('transaksi.index') }}" class="widget-link" title="Pesanan Saya">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </a>
                    @endauth
                    
                    <!-- User Profile Dropdown Widget -->
                    <div class="dropdown-wrapper">
                        @guest
                            <a href="{{ route('masuk') }}" class="widget-link" title="Login / Register">
                                <i class="fa-solid fa-user"></i>
                            </a>
                        @else
                            <button class="user-dropdown-btn">
                                <i class="fa-solid fa-user"></i>
                                <span class="d-none d-xl-inline" style="font-size:0.85rem; color:#ffffff; font-weight: 500; margin-left: 5px;">{{ Str::limit(Auth::user()->nama, 10) }}</span>
                            </button>
                            <div class="dropdown-menu">
                                <a href="{{ route('transaksi.index') }}" class="dropdown-item">Pesanan Saya</a>
                                <hr style="border: 0; border-top: 1px solid #f1f5f9; margin: 4px 0;">
                                <a href="{{ route('keluar') }}" class="dropdown-item" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                                    Logout
                                </a>
                                <form id="logout-form-header" action="{{ route('keluar') }}" method="POST" style="display:none;">
                                    @csrf
                                </form>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header Section End -->