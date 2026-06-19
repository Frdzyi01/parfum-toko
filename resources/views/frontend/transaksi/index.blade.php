@extends('frontend.layout.app')
@section('title', 'Riwayat Pesanan - Parfum Toko')
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ route('beranda') }}"><i class="fa fa-home"></i> Beranda</a>
                    <span>Riwayat Pesanan</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Transaction List Section Begin -->
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 style="margin-bottom:30px; border-bottom:2px solid #f3f3f3; padding-bottom:15px;">
                    Riwayat Pesanan Saya
                </h4>

                @if($transaksi->isEmpty())
                    <div class="text-center" style="padding: 60px 0;">
                        <i class="fa fa-shopping-bag" style="font-size:60px; color:#ccc;"></i>
                        <h5 style="color:#999; margin-top:20px;">Belum ada pesanan</h5>
                        <a href="{{ route('toko') }}" class="primary-btn" style="margin-top:20px;">Mulai Belanja</a>
                    </div>
                @else
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi as $t)
                            <tr>
                                <td><strong>{{ $t->nomor_invoice }}</strong></td>
                                <td>{{ $t->created_at->format('d M Y, H:i') }}</td>
                                <td>{{ $t->total_format }}</td>
                                <td>
                                    <span style="padding:5px 10px; border-radius:4px; font-size:12px;
                                                 color:#fff; background:{{ $t->warna_status }};">
                                        {{ $t->label_status }}
                                    </span>
                                </td>
                                <td>
                                    <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                        <a href="{{ route('transaksi.tampilkan', $t->nomor_invoice) }}"
                                           class="primary-btn" style="padding:8px 15px; font-size:13px;">
                                            Detail
                                        </a>
                                        @if($t->apakahBisaBayar())
                                        <a href="{{ route('transaksi.pembayaran', $t->nomor_invoice) }}"
                                           style="padding:8px 15px; font-size:13px; background:#632c9b; color:#fff; border-radius:4px; text-decoration:none; font-weight:600; display:inline-block;">
                                            <i class="fa-solid fa-qrcode"></i> Bayar
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($transaksi->hasPages())
                    <div class="text-center" style="margin-top:30px;">
                        {{ $transaksi->links() }}
                    </div>
                @endif
                @endif
            </div>
        </div>
    </div>
</section>
<!-- Transaction List Section End -->

@endsection
