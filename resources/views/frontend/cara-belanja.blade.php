@extends('frontend.layout.app')
@section('title', 'Cara Belanja - Rando Parfum')
@section('content')

<style>
    .cara-belanja-hero {
        background: linear-gradient(135deg, #632c9b 0%, #8b5fc7 50%, #a78bdb 100%);
        padding: 60px 0;
        text-align: center;
        color: #ffffff;
    }

    .cara-belanja-hero h1 {
        font-family: 'Cinzel', serif;
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .cara-belanja-hero p {
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        opacity: 0.85;
    }

    .steps-section {
        padding: 70px 0;
        background: #faf8fc;
    }

    .step-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 30px 25px;
        text-align: center;
        border: 1px solid #f1f0f5;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
    }

    .step-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(99, 44, 155, 0.1);
        border-color: rgba(99, 44, 155, 0.2);
    }

    .step-number {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #632c9b, #8b5fc7);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', sans-serif;
        font-size: 1.2rem;
        font-weight: 800;
        margin: 0 auto 18px;
        box-shadow: 0 4px 12px rgba(99, 44, 155, 0.25);
    }

    .step-icon {
        font-size: 2rem;
        color: #632c9b;
        margin-bottom: 15px;
    }

    .step-title {
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .step-desc {
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
        color: #64748b;
        line-height: 1.6;
    }

    .step-connector {
        display: none;
    }

    @media (min-width: 992px) {
        .step-connector {
            display: block;
            position: absolute;
            top: 50%;
            right: -30px;
            transform: translateY(-50%);
            color: #cbd5e1;
            font-size: 1.2rem;
            z-index: 2;
        }
    }

    .cta-section {
        padding: 50px 0;
        text-align: center;
        background: #ffffff;
    }

    .cta-section h3 {
        font-family: 'Cinzel', serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .cta-section p {
        font-family: 'Inter', sans-serif;
        font-size: 0.92rem;
        color: #64748b;
        margin-bottom: 25px;
    }

    .cta-btn {
        display: inline-block;
        padding: 14px 35px;
        background: #632c9b;
        color: #ffffff !important;
        border-radius: 30px;
        font-family: 'Inter', sans-serif;
        font-size: 0.92rem;
        font-weight: 700;
        text-decoration: none !important;
        box-shadow: 0 4px 15px rgba(99, 44, 155, 0.25);
        transition: all 0.25s ease;
    }

    .cta-btn:hover {
        background: #522283;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 44, 155, 0.35);
    }
</style>

<!-- Hero Section -->
<div class="cara-belanja-hero">
    <div class="container">
        <h1>Cara Belanja</h1>
        <p>Ikuti langkah mudah berikut untuk berbelanja di Rando Parfum</p>
    </div>
</div>

<!-- Steps Section -->
<section class="steps-section">
    <div class="container">
        <div class="row" style="row-gap: 25px;">

            <!-- Step 1 -->
            <div class="col-lg-3 col-md-6">
                <div class="step-card" style="position:relative;">
                    <div class="step-number">1</div>
                    <div class="step-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                    <h5 class="step-title">Pilih Produk</h5>
                    <p class="step-desc">Jelajahi katalog parfum kami dan pilih produk yang Anda sukai.</p>
                    <span class="step-connector"><i class="fa-solid fa-chevron-right"></i></span>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="col-lg-3 col-md-6">
                <div class="step-card" style="position:relative;">
                    <div class="step-number">2</div>
                    <div class="step-icon"><i class="fa-solid fa-cart-plus"></i></div>
                    <h5 class="step-title">Tambah ke Keranjang</h5>
                    <p class="step-desc">Klik tombol "Beli Sekarang" atau tambahkan ke keranjang belanja.</p>
                    <span class="step-connector"><i class="fa-solid fa-chevron-right"></i></span>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="col-lg-3 col-md-6">
                <div class="step-card" style="position:relative;">
                    <div class="step-number">3</div>
                    <div class="step-icon"><i class="fa-solid fa-clipboard-check"></i></div>
                    <h5 class="step-title">Checkout</h5>
                    <p class="step-desc">Periksa pesanan Anda, tambahkan catatan jika perlu, lalu klik "Buat Pesanan".</p>
                    <span class="step-connector"><i class="fa-solid fa-chevron-right"></i></span>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">4</div>
                    <div class="step-icon"><i class="fa-solid fa-qrcode"></i></div>
                    <h5 class="step-title">Lakukan Pembayaran</h5>
                    <p class="step-desc">Scan QRIS yang ditampilkan menggunakan aplikasi e-wallet atau mobile banking Anda.</p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="col-lg-3 col-md-6">
                <div class="step-card" style="position:relative;">
                    <div class="step-number">5</div>
                    <div class="step-icon"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                    <h5 class="step-title">Upload Bukti Pembayaran</h5>
                    <p class="step-desc">Screenshot bukti transfer Anda, kemudian upload pada halaman pembayaran.</p>
                    <span class="step-connector"><i class="fa-solid fa-chevron-right"></i></span>
                </div>
            </div>

            <!-- Step 6 -->
            <div class="col-lg-3 col-md-6">
                <div class="step-card" style="position:relative;">
                    <div class="step-number">6</div>
                    <div class="step-icon"><i class="fa-solid fa-hourglass-half"></i></div>
                    <h5 class="step-title">Tunggu Verifikasi Admin</h5>
                    <p class="step-desc">Admin akan memverifikasi bukti pembayaran Anda dalam waktu 1x24 jam.</p>
                    <span class="step-connector"><i class="fa-solid fa-chevron-right"></i></span>
                </div>
            </div>

            <!-- Step 7 -->
            <div class="col-lg-3 col-md-6">
                <div class="step-card" style="position:relative;">
                    <div class="step-number">7</div>
                    <div class="step-icon"><i class="fa-solid fa-box"></i></div>
                    <h5 class="step-title">Pesanan Diproses</h5>
                    <p class="step-desc">Setelah pembayaran terverifikasi, pesanan Anda akan segera diproses dan dikirim.</p>
                    <span class="step-connector"><i class="fa-solid fa-chevron-right"></i></span>
                </div>
            </div>

            <!-- Step 8 -->
            <div class="col-lg-3 col-md-6">
                <div class="step-card">
                    <div class="step-number">8</div>
                    <div class="step-icon"><i class="fa-solid fa-circle-check"></i></div>
                    <h5 class="step-title">Pesanan Selesai</h5>
                    <p class="step-desc">Parfum pilihan Anda sudah sampai. Nikmati aroma eksklusifnya!</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h3>Siap Berbelanja?</h3>
        <p>Temukan wewangian eksklusif pilihan terbaik untuk Anda</p>
        <a href="{{ route('toko') }}" class="cta-btn">
            <i class="fa-solid fa-bag-shopping"></i> Mulai Belanja Sekarang
        </a>
    </div>
</section>

@endsection
