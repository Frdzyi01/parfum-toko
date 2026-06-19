@extends('frontend.layout.app')
@section('title', 'Pembayaran - ' . $transaksi->nomor_invoice)
@section('content')

<style>
    .payment-page {
        background: linear-gradient(135deg, #f5f0ff 0%, #f8fafc 100%);
        min-height: 80vh;
        padding: 50px 0;
    }

    .payment-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(99, 44, 155, 0.08);
        border: 1px solid rgba(99, 44, 155, 0.08);
        overflow: hidden;
    }

    .payment-header {
        background: linear-gradient(135deg, #632c9b 0%, #8b5fc7 100%);
        padding: 30px 35px;
        color: #ffffff;
    }

    .payment-header-title {
        font-family: 'Cinzel', serif;
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .payment-header-subtitle {
        font-family: 'Inter', sans-serif;
        font-size: 0.85rem;
        opacity: 0.85;
    }

    .payment-body {
        padding: 35px;
    }

    .payment-invoice-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 22px;
        background: #f8f5ff;
        border-radius: 12px;
        margin-bottom: 30px;
        border: 1px solid rgba(99, 44, 155, 0.1);
    }

    .payment-invoice-label {
        font-family: 'Inter', sans-serif;
        font-size: 0.82rem;
        color: #64748b;
        margin-bottom: 3px;
    }

    .payment-invoice-value {
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
    }

    .payment-total {
        font-family: 'Inter', sans-serif;
        font-size: 1.6rem;
        font-weight: 800;
        color: #632c9b;
    }

    .payment-qris-section {
        text-align: center;
        padding: 30px 0;
    }

    .payment-qris-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 20px;
        background: #f1f5f9;
        border-radius: 30px;
        font-family: 'Inter', sans-serif;
        font-size: 0.82rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 20px;
    }

    .payment-qris-image {
        max-width: 280px;
        margin: 0 auto;
        padding: 15px;
        background: #ffffff;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }

    .payment-qris-image img {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .payment-instructions {
        margin-top: 25px;
        padding: 20px 25px;
        background: #fffbeb;
        border-radius: 12px;
        border: 1px solid #fde68a;
    }

    .payment-instructions h6 {
        font-family: 'Inter', sans-serif;
        font-size: 0.88rem;
        font-weight: 700;
        color: #92400e;
        margin-bottom: 10px;
    }

    .payment-instructions ol {
        padding-left: 18px;
        margin: 0;
    }

    .payment-instructions li {
        font-family: 'Inter', sans-serif;
        font-size: 0.82rem;
        color: #78350f;
        margin-bottom: 5px;
        line-height: 1.5;
    }

    .payment-divider {
        height: 1px;
        background: #e2e8f0;
        margin: 30px 0;
    }

    .upload-section-title {
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 15px;
    }

    .upload-area {
        border: 2px dashed #cbd5e1;
        border-radius: 14px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s ease;
        background: #f8fafc;
        position: relative;
    }

    .upload-area:hover {
        border-color: #632c9b;
        background: #faf8ff;
    }

    .upload-area.has-file {
        border-color: #632c9b;
        border-style: solid;
        background: #f5f0ff;
    }

    .upload-icon {
        font-size: 2.5rem;
        color: #94a3b8;
        margin-bottom: 10px;
    }

    .upload-area.has-file .upload-icon {
        color: #632c9b;
    }

    .upload-text {
        font-family: 'Inter', sans-serif;
        font-size: 0.88rem;
        color: #64748b;
    }

    .upload-text strong {
        color: #632c9b;
    }

    .upload-hint {
        font-family: 'Inter', sans-serif;
        font-size: 0.75rem;
        color: #94a3b8;
        margin-top: 6px;
    }

    .upload-preview {
        display: none;
        margin-top: 15px;
    }

    .upload-preview img {
        max-height: 200px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .upload-filename {
        display: none;
        margin-top: 10px;
        font-family: 'Inter', sans-serif;
        font-size: 0.82rem;
        font-weight: 600;
        color: #632c9b;
    }

    .btn-submit-payment {
        display: block;
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #632c9b 0%, #8b5fc7 100%);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s ease;
        margin-top: 20px;
        box-shadow: 0 4px 15px rgba(99, 44, 155, 0.25);
    }

    .btn-submit-payment:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 44, 155, 0.35);
    }

    .btn-submit-payment:disabled {
        background: #cbd5e1;
        box-shadow: none;
        cursor: not-allowed;
        transform: none;
    }

    .payment-sidebar {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(99, 44, 155, 0.08);
        border: 1px solid rgba(99, 44, 155, 0.08);
        padding: 30px;
    }

    .payment-sidebar h6 {
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f1f5f9;
    }

    .sidebar-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f8fafc;
    }

    .sidebar-item-img {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #f1f5f9;
    }

    .sidebar-item-name {
        font-family: 'Inter', sans-serif;
        font-size: 0.82rem;
        font-weight: 600;
        color: #334155;
        flex: 1;
    }

    .sidebar-item-qty {
        font-family: 'Inter', sans-serif;
        font-size: 0.75rem;
        color: #94a3b8;
    }

    .sidebar-item-price {
        font-family: 'Inter', sans-serif;
        font-size: 0.82rem;
        font-weight: 700;
        color: #0f172a;
    }

    .sidebar-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 2px solid #f1f5f9;
    }

    .sidebar-total-label {
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        color: #64748b;
    }

    .sidebar-total-value {
        font-family: 'Inter', sans-serif;
        font-size: 1.2rem;
        font-weight: 800;
        color: #632c9b;
    }

    .payment-timer {
        text-align: center;
        margin-top: 20px;
        padding: 15px;
        background: #fff5f5;
        border-radius: 12px;
        border: 1px solid #fecaca;
    }

    .payment-timer-label {
        font-family: 'Inter', sans-serif;
        font-size: 0.78rem;
        color: #991b1b;
        font-weight: 600;
    }

    .payment-timer-value {
        font-family: 'Inter', sans-serif;
        font-size: 1.4rem;
        font-weight: 800;
        color: #dc2626;
        margin-top: 4px;
    }

    .payment-secure {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 15px;
        font-family: 'Inter', sans-serif;
        font-size: 0.75rem;
        color: #94a3b8;
    }

    .payment-secure i {
        color: #22c55e;
    }
</style>

<div class="payment-page">
    <div class="container" style="max-width: 1100px;">

        <div class="row">
            <!-- Main Payment Section -->
            <div class="col-lg-7 mb-4">
                <div class="payment-card">
                    <div class="payment-header">
                        <div class="payment-header-title">
                            <i class="fa-solid fa-qrcode"></i> Pembayaran QRIS
                        </div>
                        <div class="payment-header-subtitle">
                            Scan QR Code di bawah untuk melakukan pembayaran
                        </div>
                    </div>

                    <div class="payment-body">
                        <!-- Invoice Info -->
                        <div class="payment-invoice-info">
                            <div>
                                <div class="payment-invoice-label">No. Invoice</div>
                                <div class="payment-invoice-value">{{ $transaksi->nomor_invoice }}</div>
                            </div>
                            <div style="text-align:right;">
                                <div class="payment-invoice-label">Total Pembayaran</div>
                                <div class="payment-total">{{ $transaksi->total_format }}</div>
                            </div>
                        </div>

                        <!-- QRIS Code -->
                        <div class="payment-qris-section">
                            <div class="payment-qris-label">
                                <i class="fa-solid fa-shield-halved"></i> Pembayaran Aman via QRIS
                            </div>
                            <div class="payment-qris-image">
                                <img src="{{ asset('qris.png') }}" alt="QRIS Payment">
                            </div>
                        </div>

                        <!-- Instructions -->
                        <div class="payment-instructions">
                            <h6><i class="fa-solid fa-circle-info"></i> Cara Pembayaran:</h6>
                            <ol>
                                <li>Buka aplikasi e-wallet atau mobile banking Anda</li>
                                <li>Pilih menu <strong>Scan QR / QRIS</strong></li>
                                <li>Scan kode QR di atas atau screenshot kode QR</li>
                                <li>Masukkan jumlah: <strong>{{ $transaksi->total_format }}</strong></li>
                                <li>Konfirmasi dan selesaikan pembayaran</li>
                                <li><strong>Screenshot bukti pembayaran</strong> lalu upload di bawah</li>
                            </ol>
                        </div>

                        <div class="payment-divider"></div>

                        <!-- Upload Section -->
                        <h5 class="upload-section-title">
                            <i class="fa-solid fa-cloud-arrow-up" style="color:#632c9b;"></i> Upload Bukti Pembayaran
                        </h5>

                        <form action="{{ route('transaksi.upload-bukti', $transaksi->nomor_invoice) }}" method="POST" enctype="multipart/form-data" id="formUpload">
                            @csrf
                            <div class="upload-area" id="uploadArea" onclick="document.getElementById('fileInput').click();">
                                <div class="upload-icon">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                                <div class="upload-text">
                                    Klik di sini atau <strong>seret file</strong> untuk upload
                                </div>
                                <div class="upload-hint">
                                    Format: JPG, JPEG, PNG (Maks. 2MB)
                                </div>
                                <div class="upload-preview" id="uploadPreview">
                                    <img id="previewImage" src="" alt="Preview">
                                </div>
                                <div class="upload-filename" id="uploadFilename"></div>
                                <input type="file" name="bukti_pembayaran" id="fileInput" accept="image/jpeg,image/jpg,image/png" style="display:none;">
                            </div>

                            @error('bukti_pembayaran')
                                <div style="margin-top:8px; color:#dc2626; font-size:0.82rem; font-weight:500;">
                                    <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                </div>
                            @enderror

                            <button type="submit" class="btn-submit-payment" id="btnSubmit" disabled>
                                <i class="fa-solid fa-paper-plane"></i> Konfirmasi Pembayaran
                            </button>
                        </form>

                        <div class="payment-secure">
                            <i class="fa-solid fa-lock"></i> Transaksi aman & terenkripsi
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="col-lg-5">
                <div class="payment-sidebar">
                    <h6><i class="fa-solid fa-receipt"></i> Ringkasan Pesanan</h6>

                    @foreach($transaksi->item as $item)
                    <div class="sidebar-item">
                        <img src="{{ $item->produk->gambar_mini_url }}" alt="{{ $item->produk->nama }}" class="sidebar-item-img">
                        <div style="flex:1;">
                            <div class="sidebar-item-name">{{ $item->produk->nama }}</div>
                            <div class="sidebar-item-qty">x{{ $item->jumlah }}</div>
                        </div>
                        <div class="sidebar-item-price">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach

                    <div class="sidebar-total">
                        <span class="sidebar-total-label">Total</span>
                        <span class="sidebar-total-value">{{ $transaksi->total_format }}</span>
                    </div>

                    <!-- Timer -->
                    <div class="payment-timer">
                        <div class="payment-timer-label">
                            <i class="fa-solid fa-clock"></i> Batas Waktu Pembayaran
                        </div>
                        <div class="payment-timer-value" id="countdownTimer">24:00:00</div>
                    </div>

                    @if($transaksi->catatan)
                    <div style="margin-top:15px; padding:12px; background:#f8fafc; border-radius:8px;">
                        <small style="color:#94a3b8; font-weight:600;">Catatan:</small>
                        <p style="margin:4px 0 0; font-size:0.82rem; color:#475569;">{{ $transaksi->catatan }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // File upload preview
    document.getElementById('fileInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const uploadArea = document.getElementById('uploadArea');
        const preview = document.getElementById('uploadPreview');
        const previewImg = document.getElementById('previewImage');
        const filename = document.getElementById('uploadFilename');
        const btnSubmit = document.getElementById('btnSubmit');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                previewImg.src = ev.target.result;
                preview.style.display = 'block';
                filename.style.display = 'block';
                filename.textContent = '✓ ' + file.name;
                uploadArea.classList.add('has-file');
                btnSubmit.disabled = false;
            };
            reader.readAsDataURL(file);
        }
    });

    // Countdown timer (24 hours from transaction creation)
    (function() {
        const createdAt = new Date('{{ $transaksi->created_at->toISOString() }}');
        const deadline = new Date(createdAt.getTime() + 24 * 60 * 60 * 1000);
        const timerEl = document.getElementById('countdownTimer');

        function updateTimer() {
            const now = new Date();
            const diff = deadline - now;

            if (diff <= 0) {
                timerEl.textContent = 'Waktu Habis';
                timerEl.style.color = '#dc2626';
                return;
            }

            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            timerEl.textContent =
                String(hours).padStart(2, '0') + ':' +
                String(minutes).padStart(2, '0') + ':' +
                String(seconds).padStart(2, '0');
        }

        updateTimer();
        setInterval(updateTimer, 1000);
    })();
</script>

@endsection
