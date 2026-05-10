@extends('frontend.layout.app')
@section('title', 'Detail Pesanan ' . $transaction->invoice_number . ' - Parfum Toko')
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                    <a href="{{ route('transactions.index') }}">Riwayat Pesanan</a>
                    <span>{{ $transaction->invoice_number }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Transaction Detail Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div style="background:#fff; border:1px solid #eee; border-radius:6px; padding:30px; margin-bottom:30px;">
                    <h5 style="border-bottom:1px solid #f3f3f3; padding-bottom:15px; margin-bottom:20px;">
                        Detail Pesanan
                    </h5>

                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaction->items as $item)
                                <tr>
                                    <td class="cart__product__item">
                                        <img src="{{ $item->product->thumbnail_url }}"
                                             alt="{{ $item->product->name }}"
                                             style="width:60px; height:60px; object-fit:cover;" />
                                        <div class="cart__product__item__title">
                                            <h6>{{ $item->product->name }}</h6>
                                        </div>
                                    </td>
                                    <td class="cart__price">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $item->qty }}</td>
                                    <td class="cart__total">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="checkout__order">
                    <h5>Informasi Pesanan</h5>
                    <div class="checkout__order__product">
                        <ul>
                            <li>
                                <span class="top__text">Invoice</span>
                                <span class="top__text__right">{{ $transaction->invoice_number }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="checkout__order__total">
                        <ul>
                            <li>
                                Status
                                <span>
                                    <span style="padding:3px 8px; border-radius:4px; font-size:12px; color:#fff;
                                                 background:{{ match($transaction->status) {
                                                    'pending' => '#ffc107',
                                                    'processing' => '#17a2b8',
                                                    'completed' => '#28a745',
                                                    'cancelled' => '#dc3545',
                                                    default => '#6c757d'
                                                 } }};">
                                        {{ $transaction->status_label }}
                                    </span>
                                </span>
                            </li>
                            <li>Tanggal <span>{{ $transaction->created_at->format('d M Y, H:i') }}</span></li>
                            <li>Total <span>{{ $transaction->formatted_total }}</span></li>
                        </ul>
                    </div>

                    @if($transaction->notes)
                    <div style="margin-top:15px; padding:12px; background:#f9f9f9; border-radius:4px;">
                        <small style="color:#999;">Catatan:</small>
                        <p style="margin:5px 0 0; color:#666;">{{ $transaction->notes }}</p>
                    </div>
                    @endif

                    <a href="{{ route('transactions.index') }}" class="site-btn" style="display:block; text-align:center; margin-top:20px;">
                        Kembali ke Pesanan
                    </a>
                    <a href="{{ route('shop') }}" class="primary-btn" style="display:block; text-align:center; margin-top:10px;">
                        Belanja Lagi
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Transaction Detail Section End -->

@endsection
