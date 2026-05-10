@extends('frontend.layout.app')
@section('title', 'Checkout - Parfum Toko')
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                    <a href="{{ route('cart.index') }}">Keranjang</a>
                    <span>Checkout</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <form action="{{ route('checkout.process') }}" method="POST" class="checkout__form">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <h5>Informasi Pemesan</h5>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Nama Lengkap</p>
                                <input type="text" value="{{ Auth::user()->name }}" readonly style="background:#f5f5f5;">
                            </div>
                            <div class="checkout__form__input">
                                <p>Email</p>
                                <input type="text" value="{{ Auth::user()->email }}" readonly style="background:#f5f5f5;">
                            </div>
                            <div class="checkout__form__input">
                                <p>Catatan Pesanan <span style="font-weight:normal;font-size:12px;">(opsional)</span></p>
                                <input type="text" name="notes" placeholder="Catatan khusus untuk pesanan Anda..."
                                       value="{{ old('notes') }}">
                                @error('notes')
                                    <small style="color:red;">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout__order">
                        <h5>Ringkasan Pesanan</h5>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Produk</span>
                                    <span class="top__text__right">Total</span>
                                </li>
                                @foreach($cart->items as $index => $item)
                                <li>
                                    {{ $index + 1 }}. {{ $item->product->name }}
                                    (x{{ $item->qty }})
                                    <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="checkout__order__total">
                            <ul>
                                <li>Subtotal <span>Rp {{ number_format($cart->getTotal(), 0, ',', '.') }}</span></li>
                                <li>Total <span>Rp {{ number_format($cart->getTotal(), 0, ',', '.') }}</span></li>
                            </ul>
                        </div>
                        <div class="checkout__order__widget">
                            <p style="color:#666; font-size:13px;">
                                <i class="fa fa-info-circle"></i>
                                Pembayaran dilakukan secara manual setelah order dikonfirmasi.
                            </p>
                        </div>
                        <button type="submit" class="site-btn">Buat Pesanan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Checkout Section End -->

@endsection