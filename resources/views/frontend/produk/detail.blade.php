@extends('frontend.layout.app')
@section('title', $produk->nama . ' - Parfum Toko')
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option" style="background: transparent; padding: 25px 0 10px 0;">
    <div class="container" style="max-width: 1200px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links" style="font-family: 'Inter', sans-serif; font-size: 0.9rem; color: #64748b;">
                    <a href="{{ route('beranda') }}" style="color: #64748b; text-decoration: none;">Beranda</a>
                    <span style="margin: 0 8px; color: #cbd5e1;">&gt;</span>
                    <a href="{{ route('toko') }}" style="color: #64748b; text-decoration: none;">Katalog</a>
                    <span style="margin: 0 8px; color: #cbd5e1;">&gt;</span>
                    <span style="color: #1e293b; font-weight: 500;">{{ $produk->nama }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Details Section Begin -->
<section class="product-details spad" style="padding-top: 15px; padding-bottom: 80px; font-family: 'Inter', sans-serif;">
    <div class="container" style="max-width: 1200px;">
        <div class="row" style="margin-bottom: 60px;">
            <!-- Left Column: Product Image -->
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="product-image-card" style="border: 1px solid #e2e8f0; border-radius: 20px; overflow: hidden; background-color: #ffffff; box-shadow: 0 10px 30px rgba(0,0,0,0.015); display: flex; align-items: center; justify-content: center; padding: 30px; min-height: 480px; height: 100%;">
                    <img src="{{ $produk->gambar_mini_url }}" alt="{{ $produk->nama }}" style="max-width: 100%; max-height: 440px; object-fit: contain; border-radius: 12px;" />
                </div>
            </div>
            
            <!-- Right Column: Product Info & Form -->
            <div class="col-lg-6">
                <div class="product-info-container" style="padding: 10px 0 10px 20px;">
                    <!-- Product Name -->
                    <h1 style="font-family: 'Montserrat', sans-serif; font-size: 2.2rem; font-weight: 700; color: #0f172a; margin-bottom: 6px; letter-spacing: -0.5px; line-height: 1.2;">
                        {{ $produk->nama }}
                    </h1>
                    
                    <!-- Category -->
                    <div style="font-size: 0.95rem; color: #64748b; margin-bottom: 20px; font-weight: 500;">
                        {{ $produk->kategori }}
                    </div>
                    
                    <!-- Price -->
                    <div style="font-family: 'Montserrat', sans-serif; font-size: 2rem; font-weight: 700; color: #632c9b; margin-bottom: 12px; letter-spacing: -0.5px;">
                        {{ $produk->harga_format }}
                    </div>
                    
                    <!-- Stock Status -->
                    <div style="margin-bottom: 28px; display: flex; align-items: center; gap: 8px;">
                        @if($produk->apakahAdaStok())
                            <span style="display: inline-block; width: 8px; height: 8px; background-color: #10b981; border-radius: 50%;"></span>
                            <span style="color: #10b981; font-weight: 600; font-size: 0.95rem;">Stok tersedia</span>
                        @else
                            <span style="display: inline-block; width: 8px; height: 8px; background-color: #ef4444; border-radius: 50%;"></span>
                            <span style="color: #ef4444; font-weight: 600; font-size: 0.95rem;">Stok habis</span>
                        @endif
                    </div>
                    
                    <!-- Description -->
                    <div style="margin-bottom: 35px;">
                        <h4 style="font-size: 1.05rem; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Deskripsi</h4>
                        <p style="font-size: 0.95rem; color: #475569; line-height: 1.7; margin-bottom: 0;">
                            {{ $produk->deskripsi ?? 'Tidak ada deskripsi produk.' }}
                        </p>
                    </div>
                    
                    <!-- Order Form -->
                    <form action="{{ route('keranjang.tambah', $produk->id) }}" method="POST" id="order-form">
                        @csrf
                        

                        
                        <!-- Row 2: Jumlah & Action Buttons (Side by Side) -->
                        <div class="row align-items-end">
                            <!-- Left: Quantity Selector -->
                            <div class="col-sm-5 mb-4 mb-sm-0">
                                <label style="display: block; font-size: 0.9rem; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Jumlah</label>
                                <div style="display: inline-flex; align-items: center; border: 1.5px solid #e2e8f0; border-radius: 12px; overflow: hidden; background-color: #ffffff; height: 48px; width: 140px;">
                                    <button type="button" id="qty-minus-btn" style="background: none; border: none; width: 44px; height: 100%; cursor: pointer; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; transition: color 0.2s; outline: none;">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <input type="number" id="qty-input" name="jumlah" value="1" min="1" max="{{ $produk->stok }}" style="border: none; width: 52px; height: 100%; text-align: center; font-family: inherit; font-weight: 600; font-size: 1rem; color: #0f172a; outline: none; appearance: textfield; margin: 0; padding: 0;" {{ !$produk->apakahAdaStok() ? 'disabled' : '' }} />
                                    <button type="button" id="qty-plus-btn" style="background: none; border: none; width: 44px; height: 100%; cursor: pointer; color: #64748b; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; transition: color 0.2s; outline: none;">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Right: Add to Cart & Buy Now Buttons -->
                            <div class="col-sm-7">
                                <div style="display: flex; flex-direction: column; gap: 12px;">
                                    @if($produk->apakahAdaStok())
                                        @guest
                                            <!-- Guest Buttons: Redirect to Login -->
                                            <a href="{{ route('masuk') }}" style="display: flex; align-items: center; justify-content: center; height: 48px; background-color: #632c9b; color: #ffffff; font-weight: 600; font-size: 0.95rem; border-radius: 12px; text-decoration: none; border: none; box-shadow: 0 4px 12px rgba(99,44,155,0.15); transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#522283'" onmouseout="this.style.backgroundColor='#632c9b'">
                                                Tambah ke Keranjang
                                            </a>
                                            <a href="{{ route('masuk') }}" style="display: flex; align-items: center; justify-content: center; height: 48px; background-color: #ffffff; color: #632c9b; font-weight: 600; font-size: 0.95rem; border-radius: 12px; border: 1.5px solid #632c9b; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#fdfaff'" onmouseout="this.style.backgroundColor='#ffffff'">
                                                Beli Sekarang
                                            </a>
                                        @endguest
                                        @auth
                                            <!-- Tambah ke Keranjang -->
                                            <button type="submit" style="display: flex; align-items: center; justify-content: center; height: 48px; background-color: #632c9b; color: #ffffff; font-weight: 600; font-size: 0.95rem; border-radius: 12px; border: none; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 12px rgba(99,44,155,0.15); outline: none;" onmouseover="this.style.backgroundColor='#522283'" onmouseout="this.style.backgroundColor='#632c9b'">
                                                Tambah ke Keranjang
                                            </button>
                                            
                                            <!-- Beli Sekarang -->
                                            <button type="button" id="buy-now-btn" style="display: flex; align-items: center; justify-content: center; height: 48px; background-color: #ffffff; color: #632c9b; font-weight: 600; font-size: 0.95rem; border-radius: 12px; border: 1.5px solid #632c9b; cursor: pointer; transition: all 0.2s; outline: none;" onmouseover="this.style.backgroundColor='#fdfaff'" onmouseout="this.style.backgroundColor='#ffffff'">
                                                Beli Sekarang
                                            </button>
                                        @endauth
                                    @else
                                        <button type="button" disabled style="display: flex; align-items: center; justify-content: center; height: 48px; background-color: #cbd5e1; color: #64748b; font-weight: 600; font-size: 0.95rem; border-radius: 12px; border: none; cursor: not-allowed; width: 100%;">
                                            Stok Habis
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        @if($produkTerkait->count())
        <div class="row" style="margin-top: 40px; border-top: 1px solid #f1f5f9; padding-top: 50px;">
            <div class="col-lg-12 text-center" style="margin-bottom: 40px;">
                <h3 style="font-family: 'Montserrat', sans-serif; font-size: 1.5rem; font-weight: 700; color: #0f172a; text-transform: uppercase; letter-spacing: 1px;">
                    Produk Terkait
                </h3>
                <div style="width: 50px; height: 3px; background-color: #632c9b; margin: 12px auto 0 auto; border-radius: 2px;"></div>
            </div>
            
            @foreach($produkTerkait as $terkait)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg"
                        data-setbg="{{ $terkait->gambar_mini_url }}"
                        style="height: 270px; background-size: cover; background-position: center; border-radius: 16px; position: relative;">
                        <ul class="product__hover" style="position: absolute; left: 0; bottom: 15px; width: 100%; text-align: center; margin: 0; padding: 0; display: flex; justify-content: center; gap: 8px;">
                            <li>
                                <a href="{{ $terkait->gambar_mini_url }}" class="image-popup" style="width: 40px; height: 40px; background: #ffffff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #111111; font-size: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                                    <span class="arrow_expand"></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('produk.tampilkan', $terkait->slug) }}" style="width: 40px; height: 40px; background: #ffffff; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #111111; font-size: 1rem; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                                    <span class="icon_bag_alt"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product__item__text" style="padding-top: 15px; text-align: center;">
                        <h6 style="margin-bottom: 5px;">
                            <a href="{{ route('produk.tampilkan', $terkait->slug) }}" style="color: #1e293b; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 0.95rem; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#632c9b'" onmouseout="this.style.color='#1e293b'">
                                {{ $terkait->nama }}
                            </a>
                        </h6>
                        <div class="product__price" style="color: #632c9b; font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 1rem;">
                            {{ $terkait->harga_format }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
<!-- Product Details Section End -->

<!-- JS Counter and Actions Handler -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const qtyInput = document.getElementById('qty-input');
    const plusBtn = document.getElementById('qty-plus-btn');
    const minusBtn = document.getElementById('qty-minus-btn');
    
    if (qtyInput && plusBtn && minusBtn) {
        const maxStock = parseInt(qtyInput.getAttribute('max')) || 999;
        
        plusBtn.addEventListener('click', function () {
            let currentVal = parseInt(qtyInput.value) || 1;
            if (currentVal < maxStock) {
                qtyInput.value = currentVal + 1;
            }
        });
        
        minusBtn.addEventListener('click', function () {
            let currentVal = parseInt(qtyInput.value) || 1;
            if (currentVal > 1) {
                qtyInput.value = currentVal - 1;
            }
        });
        
        qtyInput.addEventListener('change', function () {
            let currentVal = parseInt(qtyInput.value) || 1;
            if (currentVal < 1) {
                qtyInput.value = 1;
            } else if (currentVal > maxStock) {
                qtyInput.value = maxStock;
            }
        });
    }

    // Buy Now Handler
    const buyNowBtn = document.getElementById('buy-now-btn');
    const orderForm = document.getElementById('order-form');
    if (buyNowBtn && orderForm) {
        buyNowBtn.addEventListener('click', function () {
            const buyNowInput = document.createElement('input');
            buyNowInput.type = 'hidden';
            buyNowInput.name = 'beli_sekarang';
            buyNowInput.value = '1';
            orderForm.appendChild(buyNowInput);
            orderForm.submit();
        });
    }
});
</script>

@endsection
