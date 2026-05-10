@extends('frontend.layout.app')
@section('title', 'Keranjang Belanja - Parfum Toko')
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                    <span>Keranjang Belanja</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    <div class="container">
        @if($cart->items->isEmpty())
            <div class="row">
                <div class="col-lg-12 text-center" style="padding: 60px 0;">
                    <i class="icon_bag_alt" style="font-size:60px; color:#ccc;"></i>
                    <h4 style="color:#999; margin-top:20px;">Keranjang Anda kosong</h4>
                    <p style="color:#aaa;">Tambahkan produk ke keranjang terlebih dahulu.</p>
                    <a href="{{ route('shop') }}" class="primary-btn" style="margin-top:20px;">Belanja Sekarang</a>
                </div>
            </div>
        @else
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart->items as $item)
                            <tr>
                                <td class="cart__product__item">
                                    <img src="{{ $item->product->thumbnail_url }}" alt="{{ $item->product->name }}" />
                                    <div class="cart__product__item__title">
                                        <h6>
                                            <a href="{{ route('product.show', $item->product->slug) }}">
                                                {{ $item->product->name }}
                                            </a>
                                        </h6>
                                        <small style="color:#999;">Stok: {{ $item->product->stock }}</small>
                                    </div>
                                </td>
                                <td class="cart__price">{{ $item->product->formatted_price }}</td>
                                <td class="cart__quantity">
                                    <form action="{{ route('cart.update', $item->product_id) }}" method="POST" class="d-flex align-items-center">
                                        @csrf
                                        <div class="pro-qty">
                                            <input type="number" name="qty" value="{{ $item->qty }}"
                                                   min="1" max="{{ $item->product->stock }}" style="width:70px;" />
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-outline-secondary" style="margin-left:8px;">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="cart__total">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>
                                <td class="cart__close">
                                    <form action="{{ route('cart.remove', $item->product_id) }}" method="POST"
                                          onsubmit="return confirm('Hapus item ini dari keranjang?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background:none;border:none;cursor:pointer;">
                                            <span class="icon_close"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn">
                    <a href="{{ route('shop') }}">Lanjut Belanja</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 offset-lg-8">
                <div class="cart__total__procced">
                    <h6>Total Keranjang</h6>
                    <ul>
                        <li>Subtotal <span>Rp {{ number_format($cart->getTotal(), 0, ',', '.') }}</span></li>
                        <li>Total <span>Rp {{ number_format($cart->getTotal(), 0, ',', '.') }}</span></li>
                    </ul>
                    <a href="{{ route('checkout.index') }}" class="primary-btn">Lanjut ke Checkout</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- Shop Cart Section End -->

@endsection