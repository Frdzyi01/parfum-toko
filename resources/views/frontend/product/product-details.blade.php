@extends('frontend.layout.app')
@section('title', $product->name . ' - Parfum Toko')
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                    <a href="{{ route('shop') }}">Shop</a>
                    <span>{{ $product->name }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__left product__thumb nice-scroll">
                        <a class="pt active" href="#product-1">
                            <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}" />
                        </a>
                    </div>
                    <div class="product__details__slider__content">
                        <div class="product__details__pic__slider owl-carousel">
                            <img
                                data-hash="product-1"
                                class="product__big__img"
                                src="{{ $product->thumbnail_url }}"
                                alt="{{ $product->name }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product__details__text">
                    <h3>
                        {{ $product->name }}
                        <span>Stok: {{ $product->stock }}</span>
                    </h3>
                    <div class="product__details__price">
                        {{ $product->formatted_price }}
                    </div>
                    <p>{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>

                    @if($product->isInStock())
                    <div class="product__details__button">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <div class="quantity">
                                <span>Quantity:</span>
                                <div class="pro-qty">
                                    <input type="number" name="qty" value="1" min="1" max="{{ $product->stock }}" />
                                </div>
                            </div>
                            @guest
                                <a href="{{ route('login') }}" class="cart-btn">
                                    <span class="icon_bag_alt"></span> Login untuk Beli
                                </a>
                            @endguest
                            @auth
                                <button type="submit" class="cart-btn" style="border:none;cursor:pointer;background:none; color:black;">
                                    <span class="icon_bag_alt"></span> Add to cart
                                </button>
                            @endauth
                        </form>
                    </div>
                    @else
                    <div class="product__details__button">
                        <span class="cart-btn" style="background:#999;cursor:not-allowed;">
                            <span class="icon_bag_alt"></span> Stok Habis
                        </span>
                    </div>
                    @endif

                    <div class="product__details__widget">
                        <ul>
                            <li>
                                <span>Ketersediaan:</span>
                                <div class="stock__checkbox">
                                    <label>
                                        @if($product->isInStock())
                                            <span style="color:green;"><i class="fa fa-check"></i> Tersedia</span>
                                        @else
                                            <span style="color:red;"><i class="fa fa-times"></i> Stok Habis</span>
                                        @endif
                                    </label>
                                </div>
                            </li>
                            <li>
                                <span>Promotions:</span>
                                <p>Free ongkos kirim untuk pembelian pertama</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <h6>Description</h6>
                            <p>{{ $product->description ?? 'Tidak ada deskripsi produk.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if($relatedProducts->count())
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="related__title">
                    <h5>PRODUK TERKAIT</h5>
                </div>
            </div>
            @foreach($relatedProducts as $related)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg"
                        data-setbg="{{ $related->thumbnail_url }}">
                        <ul class="product__hover">
                            <li>
                                <a href="{{ $related->thumbnail_url }}" class="image-popup">
                                    <span class="arrow_expand"></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('product.show', $related->slug) }}">
                                    <span class="icon_bag_alt"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6>
                            <a href="{{ route('product.show', $related->slug) }}">
                                {{ $related->name }}
                            </a>
                        </h6>
                        <div class="product__price">{{ $related->formatted_price }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
<!-- Product Details Section End -->

@endsection