@extends('frontend.layout.app')
@section('title', 'Tentang Kami - Rando Parfum')
@section('content')

<style>
    .about-hero {
        background: linear-gradient(135deg, #632c9b 0%, #8b5fc7 50%, #a78bdb 100%);
        padding: 60px 0;
        text-align: center;
        color: #ffffff;
    }

    .about-hero h1 {
        font-family: 'Cinzel', serif;
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .about-hero p {
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        opacity: 0.85;
    }

    .about-section {
        padding: 70px 0;
        background: #ffffff;
    }

    .about-section:nth-child(even) {
        background: #faf8fc;
    }

    .about-title {
        font-family: 'Cinzel', serif;
        font-size: 1.6rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 12px;
    }

    .about-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: #632c9b;
        border-radius: 2px;
    }

    .about-title.text-center::after {
        left: 50%;
        transform: translateX(-50%);
    }

    .about-text {
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        color: #475569;
        line-height: 1.8;
    }

    .visi-misi-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 35px 30px;
        border: 1px solid #f1f0f5;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        height: 100%;
        transition: all 0.3s ease;
    }

    .visi-misi-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(99, 44, 155, 0.08);
    }

    .visi-misi-icon {
        width: 55px;
        height: 55px;
        border-radius: 14px;
        background: linear-gradient(135deg, #632c9b, #8b5fc7);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(99, 44, 155, 0.2);
    }

    .visi-misi-title {
        font-family: 'Inter', sans-serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .visi-misi-text {
        font-family: 'Inter', sans-serif;
        font-size: 0.88rem;
        color: #64748b;
        line-height: 1.7;
    }

    .visi-misi-text ul {
        padding-left: 18px;
        margin: 0;
    }

    .visi-misi-text ul li {
        margin-bottom: 8px;
    }

    .value-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 28px 24px;
        text-align: center;
        border: 1px solid #f1f0f5;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
        height: 100%;
    }

    .value-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(99, 44, 155, 0.08);
        border-color: rgba(99, 44, 155, 0.15);
    }

    .value-icon {
        font-size: 2rem;
        color: #632c9b;
        margin-bottom: 15px;
    }

    .value-title {
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .value-desc {
        font-family: 'Inter', sans-serif;
        font-size: 0.82rem;
        color: #64748b;
        line-height: 1.6;
    }
</style>

<!-- Hero Section -->
<div class="about-hero">
    <div class="container">
        <h1>Tentang Kami</h1>
        <p>Mengenal lebih dekat Rando Parfum — toko parfum online terpercaya</p>
    </div>
</div>

<!-- Profil Toko -->
<section class="about-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <h3 class="about-title">Profil Rando Parfum</h3>
                <p class="about-text">
                    <strong>Rando Parfum</strong> adalah toko parfum online yang berdedikasi menyediakan wewangian berkualitas tinggi
                    dengan harga yang terjangkau. Didirikan dengan passion terhadap dunia wewangian, kami berkomitmen untuk
                    menghadirkan koleksi parfum original dari berbagai brand ternama dunia langsung ke tangan Anda.
                </p>
                <p class="about-text" style="margin-top: 15px;">
                    Kami percaya bahwa setiap orang berhak merasakan kemewahan wewangian premium. Dengan pengalaman bertahun-tahun
                    di industri parfum, tim kami selalu berupaya memberikan rekomendasi terbaik sesuai dengan karakter dan
                    preferensi pelanggan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi -->
<section class="about-section">
    <div class="container">
        <h3 class="about-title text-center" style="text-align:center; margin-bottom:40px;">Visi & Misi</h3>
        <div class="row" style="row-gap: 25px;">
            <div class="col-lg-6">
                <div class="visi-misi-card">
                    <div class="visi-misi-icon">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <h5 class="visi-misi-title">Visi</h5>
                    <p class="visi-misi-text">
                        Menjadi toko parfum online terpercaya dan terdepan di Indonesia yang menghadirkan pengalaman belanja
                        wewangian premium yang mudah, aman, dan menyenangkan bagi setiap pelanggan.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="visi-misi-card">
                    <div class="visi-misi-icon">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h5 class="visi-misi-title">Misi</h5>
                    <div class="visi-misi-text">
                        <ul>
                            <li>Menyediakan parfum 100% original dengan jaminan keaslian produk.</li>
                            <li>Memberikan pelayanan pelanggan yang ramah, cepat, dan profesional.</li>
                            <li>Menghadirkan harga yang kompetitif dan terjangkau untuk semua kalangan.</li>
                            <li>Terus memperluas koleksi wewangian dari brand-brand ternama dunia.</li>
                            <li>Membangun kepercayaan pelanggan melalui transparansi dan integritas.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Komitmen & Pelayanan -->
<section class="about-section">
    <div class="container">
        <h3 class="about-title text-center" style="text-align:center; margin-bottom:40px;">Komitmen Kami</h3>
        <div class="row" style="row-gap: 25px;">
            <div class="col-lg-3 col-md-6">
                <div class="value-card">
                    <div class="value-icon"><i class="fa-solid fa-certificate"></i></div>
                    <h5 class="value-title">Kualitas Produk</h5>
                    <p class="value-desc">Semua produk yang kami jual dijamin 100% original dan berkualitas tinggi dari distributor resmi.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="value-card">
                    <div class="value-icon"><i class="fa-solid fa-headset"></i></div>
                    <h5 class="value-title">Pelayanan Pelanggan</h5>
                    <p class="value-desc">Tim customer service kami siap membantu Anda dengan ramah dan responsif setiap saat.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="value-card">
                    <div class="value-icon"><i class="fa-solid fa-shield-halved"></i></div>
                    <h5 class="value-title">Transaksi Aman</h5>
                    <p class="value-desc">Proses pembayaran aman dan transparan. Data pelanggan terjaga kerahasiaannya.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="value-card">
                    <div class="value-icon"><i class="fa-solid fa-truck-fast"></i></div>
                    <h5 class="value-title">Pengiriman Cepat</h5>
                    <p class="value-desc">Pesanan diproses dengan cepat dan dikemas dengan aman untuk memastikan produk sampai sempurna.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
