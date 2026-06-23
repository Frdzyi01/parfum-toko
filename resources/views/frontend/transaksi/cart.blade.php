@extends('frontend.layout.app')
@section('title', 'Keranjang Belanja - Parfum Toko')
@section('content')

<style>
    /* Premium Page Background & Base Layout */
    .cart-section-custom {
        background-color: #f8fafc;
        padding: 50px 0;
        font-family: 'Inter', sans-serif;
    }

    .cart-main-card {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.02);
        border: 1px solid #f1f5f9;
        margin-bottom: 30px;
    }

    .cart-title-custom {
        font-size: 1.8rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 25px;
        letter-spacing: -0.5px;
    }

    /* Cart Table Styles */
    .custom-cart-table-wrapper {
        overflow-x: auto;
    }

    .custom-cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 25px;
        min-width: 600px;
    }

    .custom-cart-table th {
        font-size: 0.88rem;
        font-weight: 600;
        color: #64748b;
        padding-bottom: 15px;
        border-bottom: 1.5px solid #f1f5f9;
        text-align: left;
    }

    .custom-cart-table td {
        padding: 20px 0;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .cart-product-cell {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .cart-product-img-wrap {
        background-color: #f8fafc;
        border-radius: 10px;
        width: 70px;
        height: 70px;
        padding: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #f1f5f9;
        flex-shrink: 0;
    }

    .cart-product-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .cart-product-name {
        font-size: 0.98rem;
        font-weight: 700;
        color: #1e293b;
        text-decoration: none;
        transition: color 0.2s;
    }

    .cart-product-name:hover {
        color: #632c9b;
    }

    .cart-product-size {
        font-size: 0.82rem;
        color: #94a3b8;
        margin-top: 3px;
        font-weight: 500;
    }

    .cart-price-cell {
        font-size: 0.98rem;
        font-weight: 700;
        color: #334155;
    }

    .cart-subtotal-cell {
        font-size: 0.98rem;
        font-weight: 700;
        color: #334155;
    }

    /* Custom Qty Selector */
    .custom-qty-wrapper {
        display: inline-flex;
        align-items: center;
        border: 1.5px solid #cbd5e1;
        border-radius: 8px;
        overflow: hidden;
        background-color: #ffffff;
    }

    .qty-btn {
        border: none;
        background: none;
        width: 32px;
        height: 32px;
        font-size: 1rem;
        font-weight: 600;
        color: #64748b;
        cursor: pointer;
        transition: background-color 0.2s, color 0.2s;
        outline: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qty-btn:hover {
        background-color: #f1f5f9;
        color: #632c9b;
    }

    .qty-btn:active {
        background-color: #e2e8f0;
    }

    .qty-input {
        border: none;
        width: 38px;
        height: 32px;
        text-align: center;
        font-size: 0.9rem;
        font-weight: 600;
        color: #1e293b;
        outline: none;
        -moz-appearance: textfield;
        background-color: #ffffff;
    }

    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Trash delete button */
    .cart-remove-btn {
        background: none;
        border: none;
        color: #ef4444;
        cursor: pointer;
        font-size: 1.05rem;
        padding: 8px;
        border-radius: 8px;
        transition: background-color 0.2s, color 0.2s;
        outline: none;
    }

    .cart-remove-btn:hover {
        background-color: #fef2f2;
        color: #dc2626;
    }

    /* Continue shopping button */
    .btn-continue-shopping {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 22px;
        border: 1.5px solid #cbd5e1;
        border-radius: 10px;
        background-color: #ffffff;
        color: #475569;
        font-size: 0.88rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-continue-shopping:hover {
        border-color: #94a3b8;
        color: #1e293b;
        background-color: #f8fafc;
    }

    /* Summary Card */
    .summary-card {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 28px 24px;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.02);
        border: 1px solid #f1f5f9;
        margin-top: 57px; /* align with table head */
    }

    @media (max-width: 991px) {
        .summary-card {
            margin-top: 0;
        }
    }

    .summary-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 22px;
        position: relative;
        padding-bottom: 8px;
    }

    .summary-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 30px;
        height: 2.5px;
        background-color: #632c9b;
        border-radius: 2px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        font-size: 0.92rem;
        color: #475569;
        font-weight: 500;
    }

    .summary-row-bold {
        font-size: 1.05rem;
        font-weight: 700;
        color: #0f172a;
        border-top: 1.5px solid #f1f5f9;
        padding-top: 16px;
        margin-top: 16px;
    }

    .summary-row-bold span {
        color: #632c9b;
    }

    .btn-checkout {
        display: block;
        width: 100%;
        padding: 14px;
        background-color: #632c9b;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s;
        box-shadow: 0 4px 10px rgba(99, 44, 155, 0.15);
        margin-top: 24px;
        outline: none;
    }

    .btn-checkout:hover {
        background-color: #522283;
        box-shadow: 0 6px 14px rgba(99, 44, 155, 0.25);
    }

    .btn-checkout:active {
        transform: scale(0.98);
    }
</style>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option" style="background-color:#ffffff; border-bottom: 1px solid #f1f5f9; padding: 15px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links" style="font-family:'Inter', sans-serif;">
                    <a href="{{ route('beranda') }}" style="color:#64748b; font-weight:500; text-decoration:none;"><i class="fa fa-home" style="color:#632c9b; margin-right:4px;"></i> Beranda</a>
                    <span style="color:#0f172a; font-weight:600; margin-left: 8px;">/ &nbsp;Keranjang Belanja</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Cart Section Begin -->
<section class="cart-section-custom">
    <div class="container">
        @if($keranjang->item->isEmpty())
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" style="background:#ffffff; border-radius:16px; border:1px solid #e2e8f0; padding:80px 40px; box-shadow: 0 4px 15px rgba(0,0,0,0.015);">
                    <i class="fa-solid fa-cart-shopping" style="font-size:55px; color:#cbd5e1; margin-bottom: 20px;"></i>
                    <h4 style="color:#475569; font-weight:700; margin-bottom:8px;">Keranjang Belanja Kosong</h4>
                    <p style="color:#64748b; font-size:0.92rem; max-width:400px; margin:0 auto; margin-bottom: 24px;">Anda belum menambahkan parfum ke keranjang Anda.</p>
                    <a href="{{ route('toko') }}" class="btn-continue-shopping" style="border-color:#632c9b; color:#ffffff; background:#632c9b; box-shadow:0 4px 10px rgba(99, 44, 155, 0.15);">
                        Belanja Sekarang
                    </a>
                </div>
            </div>
        @else
        <div class="row">
            <!-- Left Column: Items Table Card -->
            <div class="col-lg-8">
                <div class="cart-main-card">
                    <h1 class="cart-title-custom">Keranjang Belanja</h1>
                    
                    <div class="custom-cart-table-wrapper">
                        <table class="custom-cart-table">
                            <thead>
                                <tr>
                                    <th style="width: 45%;">Produk</th>
                                    <th style="width: 15%;">Harga</th>
                                    <th style="width: 18%;">Jumlah</th>
                                    <th style="width: 15%;">Subtotal</th>
                                    <th style="width: 7%; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($keranjang->item as $item)
                                <tr>
                                    <!-- Product Details Cell -->
                                    <td>
                                        <div class="cart-product-cell">
                                            <div class="cart-product-img-wrap">
                                                <img src="{{ $item->produk->gambar_mini_url }}" alt="{{ $item->produk->nama }}" class="cart-product-img" />
                                            </div>
                                            <div>
                                                <a href="{{ route('produk.tampilkan', $item->produk->slug) }}" class="cart-product-name">
                                                    {{ $item->produk->nama }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Price Cell -->
                                    <td class="cart-price-cell">
                                        {{ $item->produk->harga_format }}
                                    </td>
                                    
                                    <!-- Qty Selector Cell -->
                                    <td>
                                        <form action="{{ route('keranjang.perbarui', $item->produk_id) }}" method="POST" id="qty-form-{{ $item->id }}" style="margin: 0;">
                                            @csrf
                                            <div class="custom-qty-wrapper">
                                                <button type="button" class="qty-btn" onclick="updateQty({{ $item->id }}, -1)">-</button>
                                                <input type="number" name="jumlah" id="qty-input-{{ $item->id }}" value="{{ $item->jumlah }}" 
                                                       min="1" max="{{ $item->produk->stok }}" class="qty-input" readonly>
                                                <button type="button" class="qty-btn" onclick="updateQty({{ $item->id }}, 1)">+</button>
                                            </div>
                                        </form>
                                    </td>
                                    
                                    <!-- Subtotal Cell -->
                                    <td class="cart-subtotal-cell">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                    
                                    <!-- Action Button Cell -->
                                    <td style="text-align: center;">
                                        <form action="{{ route('keranjang.hapus', $item->produk_id) }}" method="POST"
                                              onsubmit="return confirm('Hapus {{ $item->produk->nama }} dari keranjang?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cart-remove-btn" title="Hapus dari Keranjang">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Continue Shopping Button -->
                    <div style="margin-top: 10px;">
                        <a href="{{ route('toko') }}" class="btn-continue-shopping">
                            <i class="fa-solid fa-chevron-left" style="font-size:0.75rem;"></i> Lanjut Belanja
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Order Summary Panel -->
            <div class="col-lg-4">
                @php
                    $subtotal = $keranjang->ambilTotal();
                    $total = $subtotal;
                @endphp
                
                <div class="summary-card">
                    <h3 class="summary-title">Ringkasan Pesanan</h3>
                    
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
                    </div>
                    
                    <div class="summary-row summary-row-bold">
                        <span>Total</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    
                    <a href="{{ route('pemesanan.index') }}" class="btn-checkout">Checkout</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- Shop Cart Section End -->

<!-- JS Script for Qty Adjuster & Auto Form Submission -->
<script>
    function updateQty(itemId, change) {
        const input = document.getElementById('qty-input-' + itemId);
        const form = document.getElementById('qty-form-' + itemId);
        if (!input || !form) return;
        
        let newVal = parseInt(input.value) + change;
        const min = parseInt(input.getAttribute('min')) || 1;
        const max = parseInt(input.getAttribute('max')) || 999;
        
        if (newVal >= min && newVal <= max) {
            input.value = newVal;
            form.submit(); // Submit update query to CartController
        }
    }
</script>

@endsection
