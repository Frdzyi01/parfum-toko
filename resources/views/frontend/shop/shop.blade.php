@extends('frontend.layout.app')
@section('title', 'Shop - Parfum Toko')
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                    <span>Shop</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="shop__sidebar">
                    <div class="sidebar__filter">
                        <div class="section-title">
                            <h4>Filter Harga</h4>
                        </div>
                        <div class="filter-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="0" data-max="5000000"></div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <p>Harga:</p>
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    @forelse($products as $product)
                    <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ $product->thumbnail_url }}">
                                @if($product->stock == 0)
                                    <div class="label stockout">Habis</div>
                                @endif
                                <ul class="product__hover">
                                    <li>
                                        <a href="{{ $product->thumbnail_url }}" class="image-popup">
                                            <span class="arrow_expand"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('product.show', $product->slug) }}">
                                            <span class="icon_bag_alt"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6>
                                    <a href="{{ route('product.show', $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h6>
                                <div class="product__price">{{ $product->formatted_price }}</div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-lg-12">
                        <div class="text-center" style="padding: 60px 0;">
                            <i class="fa fa-shopping-bag" style="font-size:50px; color:#ccc;"></i>
                            <h5 style="color:#999; margin-top:20px;">Belum ada produk yang tersedia.</h5>
                        </div>
                    </div>
                    @endforelse

                    @if($products->hasPages())
                    <div class="col-lg-12 text-center">
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

@endsection