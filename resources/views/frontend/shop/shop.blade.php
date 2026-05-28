@extends('frontend.layout.app')
@section('title', 'Shop - Parfum Toko')
@section('content')

<style>
    /* Premium Page Background & Base Layout */
    .shop-section-custom {
        background-color: #f8fafc;
        padding: 50px 0;
        font-family: 'Inter', sans-serif;
    }

    .shop-sidebar-card {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.02);
        border: 1px solid #f1f5f9;
        margin-bottom: 30px;
    }

    .shop-sidebar-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 8px;
        font-family: 'Inter', sans-serif;
    }

    .shop-sidebar-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 30px;
        height: 2.5px;
        background-color: #632c9b;
        border-radius: 2px;
    }

    /* Category Checkboxes */
    .category-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .custom-checkbox-container {
        display: flex;
        align-items: center;
        position: relative;
        cursor: pointer;
        font-size: 0.92rem;
        user-select: none;
        color: #475569;
        font-weight: 500;
        transition: color 0.2s;
    }

    .custom-checkbox-container:hover {
        color: #632c9b;
    }

    .custom-checkbox-container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .custom-checkbox-checkmark {
        height: 18px;
        width: 18px;
        background-color: #ffffff;
        border: 1.5px solid #cbd5e1;
        border-radius: 5px;
        margin-right: 12px;
        display: inline-block;
        position: relative;
        transition: all 0.2s;
    }

    .custom-checkbox-container input:checked ~ .custom-checkbox-checkmark {
        background-color: #632c9b;
        border-color: #632c9b;
    }

    .custom-checkbox-checkmark:after {
        content: "";
        position: absolute;
        display: none;
        left: 5px;
        top: 2px;
        width: 4px;
        height: 8px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .custom-checkbox-container input:checked ~ .custom-checkbox-checkmark:after {
        display: block;
    }

    /* Price Slider Overrides */
    .price-range-wrapper {
        margin-top: 15px;
        margin-bottom: 25px;
    }

    .price-slider-values {
        display: flex;
        justify-content: space-between;
        font-size: 0.88rem;
        color: #475569;
        font-weight: 600;
        margin-bottom: 12px;
    }

    /* jQuery UI Slider custom styles */
    .ui-slider-horizontal {
        height: 5px !important;
        border: none !important;
        background: #e2e8f0 !important;
        border-radius: 10px !important;
        margin: 10px 0 20px 0 !important;
    }

    .ui-slider-range {
        background: #632c9b !important;
        border-radius: 10px !important;
    }

    .ui-slider-handle {
        width: 16px !important;
        height: 16px !important;
        background: #632c9b !important;
        border: 2px solid #ffffff !important;
        border-radius: 50% !important;
        top: -5px !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15) !important;
        cursor: pointer !important;
        outline: none !important;
        transition: transform 0.1s ease;
    }

    .ui-slider-handle:hover {
        transform: scale(1.15);
    }

    /* Filter button */
    .btn-filter-submit {
        width: 100%;
        padding: 12px;
        background-color: #632c9b;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 10px rgba(99, 44, 155, 0.15);
    }

    .btn-filter-submit:hover {
        background-color: #522283;
        box-shadow: 0 6px 14px rgba(99, 44, 155, 0.25);
        transform: translateY(-1px);
    }

    .btn-filter-submit:active {
        transform: translateY(1px);
    }

    /* Product Grid Card Styling */
    .shop-product-card {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 16px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.015);
        border: 1px solid #f1f5f9;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        margin-bottom: 30px;
        position: relative;
    }

    .shop-product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 30px rgba(99, 44, 155, 0.08);
        border-color: rgba(99, 44, 155, 0.15);
    }

    .shop-product-image-wrap {
        background-color: #f8fafc;
        border-radius: 12px;
        padding: 15px;
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .shop-product-image {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.4s ease;
    }

    .shop-product-card:hover .shop-product-image {
        transform: scale(1.06);
    }

    .badge-stockout {
        position: absolute;
        top: 12px;
        left: 12px;
        background-color: #ef4444;
        color: #ffffff;
        font-size: 0.72rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        z-index: 5;
        box-shadow: 0 2px 6px rgba(239, 68, 68, 0.2);
    }

    .shop-product-info {
        padding: 16px 4px 10px 4px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .shop-product-name {
        font-family: 'Inter', sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 5px;
        text-decoration: none;
        line-height: 1.35;
        transition: color 0.2s;
    }

    .shop-product-name:hover {
        color: #632c9b;
    }

    .shop-product-category {
        font-size: 0.82rem;
        color: #64748b;
        font-weight: 500;
        margin-bottom: 12px;
        text-transform: capitalize;
    }

    .shop-product-price {
        font-size: 1.15rem;
        font-weight: 700;
        color: #632c9b;
        margin-top: auto;
        margin-bottom: 16px;
    }

    /* Double Button Layout (Lihat Detail & Beli Sekarang) */
    .shop-product-btn-group {
        display: flex;
        gap: 8px;
        width: 100%;
        margin-top: auto;
    }

    .shop-product-btn-outline {
        display: block;
        padding: 10px 12px;
        text-align: center;
        border: 1.5px solid #632c9b;
        border-radius: 10px;
        background-color: transparent;
        color: #632c9b;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        flex: 1;
        outline: none;
    }

    .shop-product-btn-outline:hover {
        background-color: rgba(99, 44, 155, 0.05);
        color: #522283;
        border-color: #522283;
    }

    .shop-product-btn-solid {
        display: block;
        padding: 10.5px 12px;
        text-align: center;
        border: none;
        border-radius: 10px;
        background-color: #632c9b;
        color: #ffffff;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        flex: 1;
        cursor: pointer;
        outline: none;
        box-shadow: 0 2px 6px rgba(99, 44, 155, 0.1);
    }

    .shop-product-btn-solid:hover {
        background-color: #522283;
        box-shadow: 0 4px 10px rgba(99, 44, 155, 0.2);
    }

    .shop-product-btn-solid:active {
        transform: scale(0.97);
    }

    /* Section Header Title */
    .catalog-header-title {
        font-size: 1.6rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 28px;
        letter-spacing: -0.5px;
    }

    /* Custom Pagination Styling */
    .pagination-custom-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    
    .pagination-custom-container .pagination__option a {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 38px;
        border: 1px solid #e2e8f0;
        border-radius: 50%;
        color: #475569;
        font-weight: 600;
        margin: 0 4px;
        text-decoration: none;
        transition: all 0.2s;
    }
    
    .pagination-custom-container .pagination__option a:hover {
        background-color: #632c9b;
        border-color: #632c9b;
        color: #ffffff;
    }
</style>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option" style="background-color:#ffffff; border-bottom: 1px solid #f1f5f9; padding: 15px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links" style="font-family:'Inter', sans-serif;">
                    <a href="{{ route('home') }}" style="color:#64748b; font-weight:500; text-decoration:none;"><i class="fa fa-home" style="color:#632c9b; margin-right:4px;"></i> Home</a>
                    <span style="color:#0f172a; font-weight:600; margin-left: 8px;">/ &nbsp;Shop</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Section Begin -->
<section class="shop-section-custom">
    <div class="container">
        <div class="row">
            <!-- Left Column: Sidebar Filters -->
            <div class="col-lg-3 col-md-4">
                <form action="{{ route('shop') }}" method="GET" id="filter-form">
                    <!-- Preserve Active Search Query -->
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <div class="shop-sidebar-card">
                        <!-- Category Header -->
                        <h4 class="shop-sidebar-title">Kategori</h4>
                        
                        @php
                            $selectedCategories = (array) request('category', ['Semua']);
                            if (empty($selectedCategories)) {
                                $selectedCategories = ['Semua'];
                            }
                        @endphp
                        
                        <!-- Checkboxes List -->
                        <div class="category-list">
                            <!-- Category: Semua -->
                            <label class="custom-checkbox-container">
                                Semua
                                <input type="checkbox" name="category[]" value="Semua" id="cat-semua" 
                                    {{ in_array('Semua', $selectedCategories) ? 'checked' : '' }}>
                                <span class="custom-checkbox-checkmark"></span>
                            </label>

                            <!-- Category: Parfum Pria -->
                            <label class="custom-checkbox-container">
                                Parfum Pria
                                <input type="checkbox" name="category[]" value="Parfum Pria" class="cat-checkbox"
                                    {{ in_array('Parfum Pria', $selectedCategories) ? 'checked' : '' }}>
                                <span class="custom-checkbox-checkmark"></span>
                            </label>

                            <!-- Category: Parfum Wanita -->
                            <label class="custom-checkbox-container">
                                Parfum Wanita
                                <input type="checkbox" name="category[]" value="Parfum Wanita" class="cat-checkbox"
                                    {{ in_array('Parfum Wanita', $selectedCategories) ? 'checked' : '' }}>
                                <span class="custom-checkbox-checkmark"></span>
                            </label>

                            <!-- Category: Unisex -->
                            <label class="custom-checkbox-container">
                                Unisex
                                <input type="checkbox" name="category[]" value="Unisex" class="cat-checkbox"
                                    {{ in_array('Unisex', $selectedCategories) ? 'checked' : '' }}>
                                <span class="custom-checkbox-checkmark"></span>
                            </label>

                            <!-- Category: Mini Size -->
                            <label class="custom-checkbox-container">
                                Mini Size
                                <input type="checkbox" name="category[]" value="Mini Size" class="cat-checkbox"
                                    {{ in_array('Mini Size', $selectedCategories) ? 'checked' : '' }}>
                                <span class="custom-checkbox-checkmark"></span>
                            </label>
                        </div>

                        <!-- Price Header -->
                        <h4 class="shop-sidebar-title" style="margin-top: 35px;">Rentang Harga</h4>
                        
                        <!-- Price Range Wrapper -->
                        <div class="price-range-wrapper">
                            <div class="price-slider-values">
                                <span id="min-price-text">Rp 0</span>
                                <span id="max-price-text">Rp 5.000.000</span>
                            </div>
                            
                            <!-- JQuery UI Price Slider -->
                            <div id="custom-price-slider"></div>
                            
                            <!-- Hidden inputs to submit min/max price values -->
                            <input type="hidden" name="min_price" id="min-price-input" value="{{ request('min_price', 0) }}">
                            <input type="hidden" name="max_price" id="max-price-input" value="{{ request('max_price', 5000000) }}">
                        </div>

                        <!-- Filter Submit Button -->
                        <button type="submit" class="btn-filter-submit">Filter</button>
                    </div>
                </form>
            </div>

            <!-- Right Column: Products List -->
            <div class="col-lg-9 col-md-8">
                <!-- Dynamic Header Title -->
                <h2 class="catalog-header-title">
                    @if(request('search'))
                        Hasil Pencarian untuk "{{ request('search') }}"
                    @else
                        Semua Produk
                    @endif
                </h2>

                <div class="row">
                    @forelse($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="shop-product-card">
                            <!-- Stock Out Badge -->
                            @if($product->stock == 0)
                                <div class="badge-stockout">Habis</div>
                            @endif

                            <!-- Product Image Wrap -->
                            <div class="shop-product-image-wrap">
                                <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" class="shop-product-image">
                            </div>

                            <!-- Product Description Info -->
                            <div class="shop-product-info">
                                <a href="{{ route('product.show', $product->slug) }}" class="shop-product-name">
                                    {{ $product->name }}
                                </a>
                                <div class="shop-product-category">
                                    {{ $product->category ?? 'Parfum' }}
                                </div>
                                <div class="shop-product-price">
                                    {{ $product->formatted_price }}
                                </div>
                            </div>

                            <!-- Double Buttons: Lihat Detail & Beli Sekarang -->
                            <div class="shop-product-btn-group">
                                <!-- View Details Button -->
                                <a href="{{ route('product.show', $product->slug) }}" class="shop-product-btn-outline">
                                    Lihat <br> Detail
                                </a>

                                <!-- Buy Now Button -->
                                @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" style="margin:0; flex:1;">
                                    @csrf
                                    <input type="hidden" name="qty" value="1">
                                    <input type="hidden" name="buy_now" value="1">
                                    <button type="submit" class="shop-product-btn-solid" style="width:100%;">
                                        Beli Sekarang
                                    </button>
                                </form>
                                @else
                                <button class="shop-product-btn-solid" style="background-color:#cbd5e1; color:#94a3b8; cursor:not-allowed;" disabled>
                                    Beli Sekarang
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <!-- Empty State -->
                    <div class="col-lg-12">
                        <div class="text-center" style="background:#ffffff; border-radius:16px; border:1px solid #e2e8f0; padding:80px 40px; box-shadow: 0 4px 15px rgba(0,0,0,0.01);">
                            <i class="fa fa-shopping-bag" style="font-size:55px; color:#cbd5e1; margin-bottom: 20px;"></i>
                            <h4 style="color:#475569; font-weight:700; margin-bottom:8px;">Produk Tidak Ditemukan</h4>
                            <p style="color:#64748b; font-size:0.92rem; max-width:400px; margin:0 auto;">Maaf, tidak ada produk yang cocok dengan kriteria filter Anda saat ini. Silakan coba atur kembali filter pencarian Anda.</p>
                        </div>
                    </div>
                    @endforelse

                    <!-- Pagination Navigation -->
                    @if($products->hasPages())
                    <div class="col-lg-12 pagination-custom-container">
                        <div class="pagination__option">
                            {{ $products->links('vendor.pagination.simple') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

<!-- JS Scripts for Sidebar & Slider Synchronization -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ----------------------------------------------------
        // CATEGORY CHECKBOX TOGGLE LOGIC
        // ----------------------------------------------------
        const checkSemua = document.getElementById('cat-semua');
        const otherCheckboxes = document.querySelectorAll('.cat-checkbox');
        
        if (checkSemua) {
            // When 'Semua' checkbox changes
            checkSemua.addEventListener('change', function() {
                if (this.checked) {
                    // Uncheck all other checkboxes
                    otherCheckboxes.forEach(cb => cb.checked = false);
                } else {
                    // Re-check 'Semua' if user tries to uncheck it and nothing else is selected
                    const anyChecked = Array.from(otherCheckboxes).some(cb => cb.checked);
                    if (!anyChecked) {
                        this.checked = true;
                    }
                }
            });
            
            // When any category other than 'Semua' changes
            otherCheckboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    if (this.checked) {
                        // Uncheck 'Semua' if another category is selected
                        checkSemua.checked = false;
                    } else {
                        // Re-check 'Semua' if nothing else is selected
                        const anyChecked = Array.from(otherCheckboxes).some(cb => cb.checked);
                        if (!anyChecked) {
                            checkSemua.checked = true;
                        }
                    }
                });
            });
        }
        
        // ----------------------------------------------------
        // JQUERY UI PRICE RANGE SLIDER SETUP
        // ----------------------------------------------------
        // Wait for jQuery & jQuery UI to load
        let timer = setInterval(function() {
            if (typeof window.jQuery !== "undefined" && typeof window.jQuery.ui !== "undefined") {
                clearInterval(timer);
                
                var slider = jQuery("#custom-price-slider");
                var minInput = jQuery("#min-price-input");
                var maxInput = jQuery("#max-price-input");
                
                var initMin = parseInt(minInput.val()) || 0;
                var initMax = parseInt(maxInput.val()) || 5000000;
                
                slider.slider({
                    range: true,
                    min: 0,
                    max: 5000000,
                    step: 50000,
                    values: [initMin, initMax],
                    slide: function(event, ui) {
                        // Update text labels
                        jQuery("#min-price-text").text(formatRupiah(ui.values[0]));
                        jQuery("#max-price-text").text(formatRupiah(ui.values[1]));
                        
                        // Update hidden input values
                        minInput.val(ui.values[0]);
                        maxInput.val(ui.values[1]);
                    }
                });
                
                // Initialize labels
                jQuery("#min-price-text").text(formatRupiah(initMin));
                jQuery("#max-price-text").text(formatRupiah(initMax));
            }
        }, 100);
        
        function formatRupiah(value) {
            return 'Rp ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    });
</script>

@endsection