@extends('frontend.layout.app')
@section('content')

<style>
    /* Styling overrides for premium perfume look */
    .hero-slider-section {
        position: relative;
        overflow: hidden;
    }
    
    .hero-slider-item {
        height: 520px;
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .hero-slider-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.85) 45%, rgba(255,255,255,0) 100%);
        z-index: 1;
    }
    
    .hero-slider-content {
        position: relative;
        z-index: 2;
        max-width: 600px;
        padding-left: 50px;
        text-align: left;
    }
    
    .hero-label {
        font-family: 'Montserrat', sans-serif;
        font-size: 0.85rem;
        font-weight: 700;
        color: #632c9b;
        margin-bottom: 12px;
        letter-spacing: 3px;
        text-transform: uppercase;
        display: block;
    }
    
    .hero-title {
        font-family: 'Cinzel', serif;
        font-size: 2.8rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.25;
        margin-bottom: 18px;
    }
    
    .hero-desc {
        font-family: 'Inter', sans-serif;
        font-size: 0.98rem;
        color: #475569;
        line-height: 1.6;
        margin-bottom: 28px;
    }
    
    .btn-hero-action {
        display: inline-block;
        padding: 13px 32px;
        background-color: #632c9b;
        color: #ffffff !important;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        border-radius: 30px;
        box-shadow: 0 4px 12px rgba(99, 44, 155, 0.2);
        transition: all 0.2s ease;
    }
    
    .btn-hero-action:hover {
        background-color: #522283;
        box-shadow: 0 6px 18px rgba(99, 44, 155, 0.3);
        transform: translateY(-1px);
    }
    
    .btn-hero-action:active {
        transform: translateY(1px);
    }
    
    /* Quick Categories Navigation Row */
    .quick-categories-section {
        background-color: #ffffff;
        padding: 35px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .quick-cat-card {
        background: #f8fafc;
        border-radius: 14px;
        padding: 18px 22px;
        display: flex;
        align-items: center;
        gap: 16px;
        text-decoration: none;
        border: 1px solid #e2e8f0;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    .quick-cat-card:hover {
        transform: translateY(-3px);
        border-color: rgba(99, 44, 155, 0.25);
        box-shadow: 0 8px 24px rgba(99, 44, 155, 0.05);
        background: #ffffff;
    }
    
    .quick-cat-icon {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background-color: rgba(99, 44, 155, 0.08);
        color: #632c9b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: all 0.25s ease;
        flex-shrink: 0;
    }
    
    .quick-cat-card:hover .quick-cat-icon {
        background-color: #632c9b;
        color: #ffffff;
    }
    
    .quick-cat-info {
        text-align: left;
    }
    
    .quick-cat-name {
        font-family: 'Inter', sans-serif;
        font-size: 0.92rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 2px;
        text-decoration: none;
    }
    
    .quick-cat-desc {
        font-family: 'Inter', sans-serif;
        font-size: 0.78rem;
        color: #64748b;
    }
    
    /* Carousel Indicators customization */
    .hero-carousel .owl-dots {
        position: absolute;
        bottom: 25px;
        left: 50px;
        z-index: 2;
        display: flex;
        gap: 6px;
    }
    
    .hero-carousel .owl-dot span {
        width: 28px !important;
        height: 4px !important;
        background: #cbd5e1 !important;
        border-radius: 2px !important;
        transition: background 0.3s;
        display: block;
    }
    
    .hero-carousel .owl-dot.active span {
        background: #632c9b !important;
    }
    
    /* Product card hover effects */
    .product__item {
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        margin-bottom: 40px;
    }
    
    .product__item:hover {
        transform: translateY(-5px);
    }
    
    .product__item__pic {
        border-radius: 12px;
        overflow: hidden;
        background-color: #f8fafc;
        box-shadow: 0 4px 12px rgba(0,0,0,0.01);
        transition: box-shadow 0.3s;
    }
    
    .product__item:hover .product__item__pic {
        box-shadow: 0 8px 24px rgba(99, 44, 155, 0.08);
    }
    
    .product__item__text h6 a {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        color: #0f172a;
        transition: color 0.2s;
    }
    
    .product__item__text h6 a:hover {
        color: #632c9b;
    }
    
    .product__price {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        color: #632c9b !important;
    }
    
    /* Banner overrides */
    .banner__text span {
        color: #632c9b !important;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-family: 'Montserrat', sans-serif;
    }
    
    .banner__text h1 {
        font-family: 'Cinzel', serif;
        font-weight: 700;
        color: #1e1b29;
    }
    
    .banner__text a {
        background-color: #632c9b !important;
        border-color: #632c9b !important;
        border-radius: 24px;
        padding: 12px 30px !important;
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(99, 44, 155, 0.15);
        transition: all 0.2s;
    }
    
    .banner__text a:hover {
        background-color: #522283 !important;
        border-color: #522283 !important;
        box-shadow: 0 6px 14px rgba(99, 44, 155, 0.25);
    }
    
    /* Trend Section */
    .trend__item__text h6 a {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        color: #0f172a;
        transition: color 0.2s;
    }
    
    .trend__item__text h6 a:hover {
        color: #632c9b;
    }
    
    .trend__item__pic img {
        background-color: #f8fafc;
        border: 1px solid #f1f5f9;
    }
    
    /* Discount Section */
    .discount__text span {
        color: #632c9b !important;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-family: 'Montserrat', sans-serif;
    }
    
    .discount__text h2 {
        font-family: 'Cinzel', serif;
        font-weight: 700;
        color: #1e1b29;
    }
    
    .discount__text a {
        background-color: #632c9b !important;
        border-color: #632c9b !important;
        border-radius: 24px;
        padding: 12px 30px !important;
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(99, 44, 155, 0.15);
        transition: all 0.2s;
    }
    
    .discount__text a:hover {
        background-color: #522283 !important;
        border-color: #522283 !important;
    }
    
    /* Services icon style */
    .services__item i {
        color: #632c9b !important;
        font-size: 2.2rem !important;
        margin-bottom: 15px;
    }
    
    .services__item h6 {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        color: #0f172a;
    }
    
    /* Premium Categories Grid */
    .categories-premium {
        padding: 80px 0;
        background-color: #faf8fc;
    }
    
    .section-subtitle-premium {
        font-family: 'Montserrat', sans-serif;
        font-size: 0.8rem;
        font-weight: 700;
        color: #632c9b;
        letter-spacing: 4px;
        text-transform: uppercase;
        display: block;
        margin-bottom: 8px;
        text-align: center;
    }
    
    .section-title-premium {
        font-family: 'Cinzel', serif;
        font-size: 2.2rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 50px;
        text-align: center;
        position: relative;
    }
    
    .section-title-premium::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background-color: #632c9b;
        border-radius: 2px;
    }
    
    .premium-cat-large {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        height: 580px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(99, 44, 155, 0.1);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    .premium-cat-small {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        height: 278px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        border: 1px solid rgba(99, 44, 155, 0.1);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    .premium-cat-large:hover,
    .premium-cat-small:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(99, 44, 155, 0.12);
        border-color: rgba(99, 44, 155, 0.3);
    }
    
    .premium-cat-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    .premium-cat-large:hover .premium-cat-img,
    .premium-cat-small:hover .premium-cat-img {
        transform: scale(1.06);
    }
    
    .premium-cat-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(180deg, rgba(15, 23, 42, 0.05) 0%, rgba(15, 23, 42, 0.4) 50%, rgba(15, 23, 42, 0.85) 100%);
        z-index: 1;
        transition: background 0.4s ease;
    }
    
    .premium-cat-large:hover .premium-cat-overlay,
    .premium-cat-small:hover .premium-cat-overlay {
        background: linear-gradient(180deg, rgba(15, 23, 42, 0) 0%, rgba(15, 23, 42, 0.5) 45%, rgba(15, 23, 42, 0.92) 100%);
    }
    
    .premium-cat-content {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 40px;
        z-index: 2;
        color: #ffffff;
        box-sizing: border-box;
    }
    
    .premium-cat-small .premium-cat-content {
        padding: 24px;
    }
    
    .premium-cat-badge {
        display: inline-block;
        padding: 6px 14px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 30px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.72rem;
        font-weight: 700;
        color: #ffffff;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 16px;
    }
    
    .premium-cat-small .premium-cat-badge {
        padding: 4px 10px;
        font-size: 0.65rem;
        margin-bottom: 10px;
    }
    
    .premium-cat-title {
        font-family: 'Cinzel', serif;
        font-size: 2rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 12px;
        line-height: 1.25;
    }
    
    .premium-cat-small .premium-cat-title {
        font-size: 1.2rem;
        margin-bottom: 6px;
    }
    
    .premium-cat-desc {
        font-family: 'Inter', sans-serif;
        font-size: 0.92rem;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.5;
        margin-bottom: 24px;
        max-width: 90%;
    }
    
    .premium-cat-price {
        font-family: 'Inter', sans-serif;
        font-size: 1.05rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 14px;
        display: block;
    }
    
    .premium-cat-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 24px;
        background-color: #ffffff;
        color: #0f172a !important;
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
        font-weight: 700;
        border-radius: 30px;
        text-decoration: none !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .premium-cat-btn:hover {
        background-color: #632c9b;
        color: #ffffff !important;
        box-shadow: 0 6px 18px rgba(99, 44, 155, 0.3);
        transform: translateY(-1px);
    }
    
    .premium-cat-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #ffffff !important;
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
        font-weight: 700;
        text-decoration: none !important;
        position: relative;
    }
    
    .premium-cat-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 100%;
        height: 1.5px;
        background-color: #ffffff;
        transform: scaleX(1);
        transform-origin: left;
        transition: transform 0.3s ease;
    }
    
    .premium-cat-link:hover::after {
        transform: scaleX(0);
        transform-origin: right;
    }
    
    @media (max-width: 991px) {
        .premium-cat-large {
            height: 480px;
        }
    }
    
    @media (max-width: 575px) {
        .premium-cat-small {
            height: 240px;
        }
    }
    
    /* Double Button Layout (Lihat Detail & Beli Sekarang) on homepage */
    .product-btn-group {
        display: flex;
        gap: 8px;
        width: 100%;
        margin-top: 15px;
    }

    .product-btn-outline {
        display: block;
        padding: 8px 10px;
        text-align: center;
        border: 1.5px solid #632c9b;
        border-radius: 8px;
        background-color: transparent;
        color: #632c9b !important;
        font-family: 'Inter', sans-serif;
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none !important;
        transition: all 0.2s ease;
        flex: 1;
        outline: none;
    }

    .product-btn-outline:hover {
        background-color: rgba(99, 44, 155, 0.05);
        color: #522283 !important;
        border-color: #522283;
    }

    .product-btn-solid {
        display: block;
        padding: 9.5px 10px;
        text-align: center;
        border: none;
        border-radius: 8px;
        background-color: #632c9b;
        color: #ffffff !important;
        font-family: 'Inter', sans-serif;
        font-size: 0.78rem;
        font-weight: 600;
        text-decoration: none !important;
        transition: all 0.2s ease;
        flex: 1;
        cursor: pointer;
        outline: none;
        box-shadow: 0 2px 6px rgba(99, 44, 155, 0.1);
    }

    .product-btn-solid:hover {
        background-color: #522283;
        box-shadow: 0 4px 10px rgba(99, 44, 155, 0.2);
    }
</style>

    <!-- Hero Slider Section Begin -->
    <section class="hero-slider-section">
        <div class="hero-carousel owl-carousel">
            <div class="hero-slider-item" style="background-image: url('https://images.unsplash.com/photo-1547887537-6158d64c35b3?q=80&w=1600');">
                <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 25px; width: 100%;">
                    <div class="hero-slider-content">
                        <span class="hero-label">Premium Fragrances</span>
                        <h1 class="hero-title">Elegansi dalam Setiap Semprotan</h1>
                        <p class="hero-desc">Temukan keajaiban wewangian original pilihan kelas dunia yang melengkapi keunikan karakter Anda. Keaslian terjamin 100% langsung dari distributor.</p>
                        <a href="{{ route('shop') }}" class="btn-hero-action">Jelajahi Katalog</a>
                    </div>
                </div>
            </div>
            <div class="hero-slider-item" style="background-image: url('https://images.unsplash.com/photo-1523293182086-7651a899d37f?q=80&w=1600');">
                <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 25px; width: 100%;">
                    <div class="hero-slider-content">
                        <span class="hero-label">Exquisite Collection</span>
                        <h1 class="hero-title">Aroma Mewah & Tahan Lama</h1>
                        <p class="hero-desc">Miliki aroma eksklusif terlaris dunia dari brand papan atas internasional seperti Chanel, Dior, dan Tom Ford dengan penawaran terbaik bulan ini.</p>
                        <a href="{{ route('shop') }}" class="btn-hero-action">Miliki Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="hero-slider-item" style="background-image: url('https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=1600');">
                <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 25px; width: 100%;">
                    <div class="hero-slider-content">
                        <span class="hero-label">Perfect Gift</span>
                        <h1 class="hero-title">Hadiah Terbaik Bagi Orang Terkasih</h1>
                        <p class="hero-desc">Dapatkan koleksi wewangian unisex dan mini size eksklusif yang sangat cocok dijadikan bingkisan mewah untuk menemani momen spesial mereka.</p>
                        <a href="{{ route('shop') }}?category[]=Mini+Size" class="btn-hero-action">Cari Mini Size</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Slider Section End -->

    <!-- Quick Categories Row Begin -->
    <section class="quick-categories-section">
        <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 25px;">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6" style="margin-bottom: 15px;">
                    <a href="{{ route('shop') }}?category[]=Parfum+Pria" class="quick-cat-card">
                        <div class="quick-cat-icon">
                            <i class="fa-solid fa-mars"></i>
                        </div>
                        <div class="quick-cat-info">
                            <h5 class="quick-cat-name">Parfum Pria</h5>
                            <span class="quick-cat-desc">Maskulin & Segar</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6" style="margin-bottom: 15px;">
                    <a href="{{ route('shop') }}?category[]=Parfum+Wanita" class="quick-cat-card">
                        <div class="quick-cat-icon">
                            <i class="fa-solid fa-venus"></i>
                        </div>
                        <div class="quick-cat-info">
                            <h5 class="quick-cat-name">Parfum Wanita</h5>
                            <span class="quick-cat-desc">Anggun & Elegan</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6" style="margin-bottom: 15px;">
                    <a href="{{ route('shop') }}?category[]=Unisex" class="quick-cat-card">
                        <div class="quick-cat-icon">
                            <i class="fa-solid fa-venus-mars"></i>
                        </div>
                        <div class="quick-cat-info">
                            <h5 class="quick-cat-name">Unisex</h5>
                            <span class="quick-cat-desc">Universal & Menawan</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6" style="margin-bottom: 15px;">
                    <a href="{{ route('shop') }}?category[]=Mini+Size" class="quick-cat-card">
                        <div class="quick-cat-icon">
                            <i class="fa-solid fa-compress"></i>
                        </div>
                        <div class="quick-cat-info">
                            <h5 class="quick-cat-name">Mini Size</h5>
                            <span class="quick-cat-desc">Praktis & Ringan</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Quick Categories Row End -->

    <!-- Categories Section Begin -->
    <section class="categories-premium">
        <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 25px;">
            <span class="section-subtitle-premium">Koleksi Pilihan</span>
            <h2 class="section-title-premium">Signature Fragrance</h2>
            
            <div class="row">
                @if(isset($heroProducts[0]))
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="premium-cat-large">
                        <div class="premium-cat-img set-bg" data-setbg="{{ $heroProducts[0]->thumbnail_url }}"></div>
                        <div class="premium-cat-overlay"></div>
                        <div class="premium-cat-content">
                            <span class="premium-cat-badge">Signature</span>
                            <h3 class="premium-cat-title">{{ $heroProducts[0]->name }}</h3>
                            <p class="premium-cat-desc">{{ Str::limit($heroProducts[0]->description, 120) }}</p>
                            <span class="premium-cat-price">{{ $heroProducts[0]->formatted_price }}</span>
                            <a href="{{ route('product.show', $heroProducts[0]->slug) }}" class="premium-cat-btn">
                                Jelajahi Aroma &nbsp;<i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="col-lg-6">
                    <div class="row">
                        @for($i = 1; $i < 5; $i++)
                            @if(isset($heroProducts[$i]))
                            <div class="col-sm-6 mb-4">
                                <div class="premium-cat-small">
                                    <div class="premium-cat-img set-bg" data-setbg="{{ $heroProducts[$i]->thumbnail_url }}"></div>
                                    <div class="premium-cat-overlay"></div>
                                    <div class="premium-cat-content">
                                        <span class="premium-cat-badge">Eksklusif</span>
                                        <h4 class="premium-cat-title">{{ $heroProducts[$i]->name }}</h4>
                                        <span class="premium-cat-price">{{ $heroProducts[$i]->formatted_price }}</span>
                                        <a href="{{ route('product.show', $heroProducts[$i]->slug) }}" class="premium-cat-link">
                                            Shop Now &nbsp;<i class="fa-solid fa-chevron-right" style="font-size: 0.75rem;"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4 col-md-4">
            <div class="section-title">
              <h4 style="font-family:'Cinzel', serif; font-weight:700; letter-spacing:1px;">Koleksi Terbaru</h4>
            </div>
          </div>
          <div class="col-lg-8 col-md-8">
            <ul class="filter__controls" style="font-family:'Inter', sans-serif; font-weight: 600;">
              <li class="active" data-filter="*">Semua</li>
              <li data-filter=".parfum-pria">Parfum Pria</li>
              <li data-filter=".parfum-wanita">Parfum Wanita</li>
              <li data-filter=".unisex">Unisex</li>
              <li data-filter=".mini-size">Mini Size</li>
            </ul>
          </div>
        </div>
        <div class="row property__gallery">
          @forelse($newProducts as $product)
          @php
              $catClass = 'other';
              if ($product->category) {
                  $catClass = Str::slug($product->category);
              }
          @endphp
          <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $catClass }}">
            <div class="product__item">
              <div
                class="product__item__pic set-bg"
                data-setbg="{{ $product->thumbnail_url }}"
              >
                @if($loop->first)
                <div class="label new" style="background:#632c9b;">New</div>
                @endif
              
              </div>
              <div class="product__item__text">
                <h6><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h6>
                <div class="rating">
                  <i class="fa fa-star text-warning"></i>
                  <i class="fa fa-star text-warning"></i>
                  <i class="fa fa-star text-warning"></i>
                  <i class="fa fa-star text-warning"></i>
                  <i class="fa fa-star text-warning"></i>
                </div>
                <div class="product__price">{{ $product->formatted_price }}</div>
                
                <!-- Double Buttons: Lihat Detail & Beli Sekarang -->
                <div class="product-btn-group">
                    <!-- View Details Button -->
                    <a href="{{ route('product.show', $product->slug) }}" class="product-btn-outline">
                        Lihat Detail
                    </a>

                    <!-- Buy Now Button -->
                    @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" style="margin:0; flex:1;">
                        @csrf
                        <input type="hidden" name="qty" value="1">
                        <input type="hidden" name="buy_now" value="1">
                        <button type="submit" class="product-btn-solid" style="width:100%;">
                            Beli Sekarang
                        </button>
                    </form>
                    @else
                    <button class="product-btn-solid" style="background-color:#cbd5e1; color:#94a3b8; cursor:not-allowed;" disabled>
                        Beli Sekarang
                    </button>
                    @endif
                </div>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center"><p>Belum ada produk yang ditemukan.</p></div>
          @endforelse
        </div>
      </div>
    </section>
    <!-- Product Section End -->

    <!-- Banner Section Begin -->
    <section class="banner set-bg" data-setbg="https://images.unsplash.com/photo-1547887537-6158d64c35b3?q=80&w=1600">
      <div class="container">
        <div class="row">
          <div class="col-xl-7 col-lg-8 m-auto">
            <div class="banner__slider owl-carousel">
              <div class="banner__item">
                <div class="banner__text">
                  <span>Koleksi Eksklusif Rando Parfum</span>
                  <h1>Temukan Karakter Aromamu</h1>
                  <a href="{{ route('shop') }}">Belanja Sekarang</a>
                </div>
              </div>
              <div class="banner__item">
                <div class="banner__text">
                  <span>Wewangian Mewah Tahan Lama</span>
                  <h1>Aroma Terbaik Setiap Momen</h1>
                  <a href="{{ route('shop') }}">Belanja Sekarang</a>
                </div>
              </div>
              <div class="banner__item">
                <div class="banner__text">
                  <span>Bahan Alami Berkualitas Tinggi</span>
                  <h1>Prestige & Elegance</h1>
                  <a href="{{ route('shop') }}">Belanja Sekarang</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Banner Section End -->

    <!-- Trend Section Begin -->
    <section class="trend spad">
      <div class="container">
        <div class="row">
          <!-- Hot Trend -->
          <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="trend__content">
              <div class="section-title">
                <h4 style="font-family:'Cinzel', serif; font-weight:700;">Hot Trend</h4>
              </div>
              @foreach($hotTrend as $product)
              <div class="trend__item">
                <div class="trend__item__pic">
                  <img src="{{ $product->thumbnail_url }}" alt="" style="width: 90px; height: 90px; object-fit: cover; border-radius: 8px;"/>
                </div>
                <div class="trend__item__text">
                  <h6><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h6>
                  <div class="rating">
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                  </div>
                  <div class="product__price">{{ $product->formatted_price }}</div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <!-- Best Seller -->
          <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="trend__content">
              <div class="section-title">
                <h4 style="font-family:'Cinzel', serif; font-weight:700;">Best Seller</h4>
              </div>
              @foreach($bestSeller as $product)
              <div class="trend__item">
                <div class="trend__item__pic">
                  <img src="{{ $product->thumbnail_url }}" alt="" style="width: 90px; height: 90px; object-fit: cover; border-radius: 8px;"/>
                </div>
                <div class="trend__item__text">
                  <h6><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h6>
                  <div class="rating">
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                  </div>
                  <div class="product__price">{{ $product->formatted_price }}</div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <!-- Feature -->
          <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="trend__content">
              <div class="section-title">
                <h4 style="font-family:'Cinzel', serif; font-weight:700;">Rekomendasi</h4>
              </div>
              @foreach($feature as $product)
              <div class="trend__item">
                <div class="trend__item__pic">
                  <img src="{{ $product->thumbnail_url }}" alt="" style="width: 90px; height: 90px; object-fit: cover; border-radius: 8px;"/>
                </div>
                <div class="trend__item__text">
                  <h6><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h6>
                  <div class="rating">
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                  </div>
                  <div class="product__price">{{ $product->formatted_price }}</div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Trend Section End -->

    <!-- Discount Section Begin -->
    <section class="discount">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 p-0">
            <div class="discount__pic">
              <img src="https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?q=80&w=800" alt="" style="width:100%; max-height: 380px; object-fit: cover;" />
            </div>
          </div>
          <div class="col-lg-6 p-0">
            <div class="discount__text" style="padding-left: 50px;">
              <div class="discount__text__title">
                <span>Promo Spesial Bulan Ini</span>
                <h2>Diskon Eksklusif Rando</h2>
                <h5><span>Hemat</span> s.d. 30%</h5>
              </div>
              <div class="discount__countdown" id="countdown-time">
                <div class="countdown__item">
                  <span>14</span>
                  <p>Days</p>
                </div>
                <div class="countdown__item">
                  <span>12</span>
                  <p>Hours</p>
                </div>
                <div class="countdown__item">
                  <span>45</span>
                  <p>Mins</p>
                </div>
                <div class="countdown__item">
                  <span>25</span>
                  <p>Secs</p>
                </div>
              </div>
              <a href="{{ route('shop') }}">Belanja Sekarang</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Discount Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="services__item">
              <i class="fa-solid fa-truck"></i>
              <h6>Gratis Ongkir</h6>
              <p>Bebas biaya kirim untuk area Jakarta</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="services__item">
              <i class="fa-solid fa-certificate"></i>
              <h6>Garansi 100% Original</h6>
              <p>Produk asli jaminan uang kembali</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="services__item">
              <i class="fa-solid fa-comments"></i>
              <h6>Layanan Konsultasi Aroma</h6>
              <p>Siap membantu pilih wewangian terbaik</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="services__item">
              <i class="fa-solid fa-credit-card"></i>
              <h6>Pembayaran Aman & Cepat</h6>
              <p>Mendukung berbagai metode bayar</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Services Section End -->

    <!-- Script for initializing Hero Slider Owl Carousel -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof jQuery !== 'undefined' && jQuery.fn.owlCarousel) {
                jQuery('.hero-carousel').owlCarousel({
                    loop: true,
                    margin: 0,
                    items: 1,
                    dots: true,
                    smartSpeed: 1200,
                    autoHeight: false,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    animateOut: 'fadeOut',
                    animateIn: 'fadeIn'
                });
            }
        });
    </script>

@endsection