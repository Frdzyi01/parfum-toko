@extends('frontend.layout.app')
@section('content')

    <!-- Categories Section Begin -->
    <section class="categories">
      <div class="container-fluid">
        <div class="row">
          @if(isset($heroProducts[0]))
          <div class="col-lg-6 p-0">
            <div
              class="categories__item categories__large__item set-bg"
              data-setbg="{{ $heroProducts[0]->thumbnail ? asset('storage/' . $heroProducts[0]->thumbnail) : asset('template-landing/img/categories/category-1.jpg') }}"
            >
              <div class="categories__text">
                <h1>{{ $heroProducts[0]->name }}</h1>
                <p>{{ Str::limit($heroProducts[0]->description, 100) }}</p>
                <a href="{{ route('product.show', $heroProducts[0]->slug) }}">Shop now</a>
              </div>
            </div>
          </div>
          @endif
          <div class="col-lg-6">
            <div class="row">
              @for($i = 1; $i < 5; $i++)
                @if(isset($heroProducts[$i]))
                <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                  <div
                    class="categories__item set-bg"
                    data-setbg="{{ $heroProducts[$i]->thumbnail ? asset('storage/' . $heroProducts[$i]->thumbnail) : asset('template-landing/img/categories/category-'.($i+1).'.jpg') }}"
                  >
                    <div class="categories__text">
                      <h4>{{ $heroProducts[$i]->name }}</h4>
                      <p>Rp {{ number_format($heroProducts[$i]->price, 0, ',', '.') }}</p>
                      <a href="{{ route('product.show', $heroProducts[$i]->slug) }}">Shop now</a>
                    </div>
                  </div>
                </div>
                @endif
              @endfor
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Categories Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4">
            <div class="section-title">
              <h4>New product</h4>
            </div>
          </div>
          <div class="col-lg-8 col-md-8">
            <ul class="filter__controls">
              <li class="active" data-filter="*">All</li>
              <li data-filter=".women">Women’s</li>
              <li data-filter=".men">Men’s</li>
              <li data-filter=".kid">Kid’s</li>
              <li data-filter=".accessories">Accessories</li>
              <li data-filter=".cosmetic">Cosmetics</li>
            </ul>
          </div>
        </div>
        <div class="row property__gallery">
          @forelse($newProducts as $product)
          <div class="col-lg-3 col-md-4 col-sm-6 mix">
            <div class="product__item">
              <div
                class="product__item__pic set-bg"
                data-setbg="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('template-landing/img/product/product-1.jpg') }}"
              >
                @if($loop->first)
                <div class="label new">New</div>
                @endif
                <ul class="product__hover">
                  <li>
                    <a href="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('template-landing/img/product/product-1.jpg') }}" class="image-popup"
                      ><span class="arrow_expand"></span
                    ></a>
                  </li>
                  <li>
                    <a href="#"><span class="icon_heart_alt"></span></a>
                  </li>
                  <li>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" style="background: none; border: none; padding: 0;">
                            <a href="javascript:void(0)" onclick="this.closest('form').submit();"><span class="icon_bag_alt"></span></a>
                        </button>
                    </form>
                  </li>
                </ul>
              </div>
              <div class="product__item__text">
                <h6><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h6>
                <div class="rating">
                  <i class="fa fa-star text-warning"></i>
                  <i class="fa fa-star text-warning"></i>
                  <i class="fa fa-star text-warning"></i>
                  <i class="fa fa-star text-warning"></i>
                  <i class="fa fa-star text-warning"></i>
                </div>
                <div class="product__price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
              </div>
            </div>
          </div>
          @empty
          <div class="col-12 text-center"><p>No products found.</p></div>
          @endforelse
        </div>
      </div>
    </section>
    <!-- Product Section End -->

    <!-- Banner Section Begin -->
    <section class="banner set-bg" data-setbg="{{ asset('template-landing/img/banner/banner-1.jpg') }}">
      <div class="container">
        <div class="row">
          <div class="col-xl-7 col-lg-8 m-auto">
            <div class="banner__slider owl-carousel">
              <div class="banner__item">
                <div class="banner__text">
                  <span>The Chloe Collection</span>
                  <h1>The Project Jacket</h1>
                  <a href="#">Shop now</a>
                </div>
              </div>
              <div class="banner__item">
                <div class="banner__text">
                  <span>The Chloe Collection</span>
                  <h1>The Project Jacket</h1>
                  <a href="#">Shop now</a>
                </div>
              </div>
              <div class="banner__item">
                <div class="banner__text">
                  <span>The Chloe Collection</span>
                  <h1>The Project Jacket</h1>
                  <a href="#">Shop now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Banner Section End -->

    <!-- Trend Section Begin -->
    <section class="trend spad">
      <div class="container">
        <div class="row">
          <!-- Hot Trend -->
          <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="trend__content">
              <div class="section-title">
                <h4>Hot Trend</h4>
              </div>
              @foreach($hotTrend as $product)
              <div class="trend__item">
                <div class="trend__item__pic">
                  <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('template-landing/img/trend/ht-1.jpg') }}" alt="" style="width: 90px; height: 90px; object-fit: cover; border-radius: 5px;"/>
                </div>
                <div class="trend__item__text">
                  <h6><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h6>
                  <div class="rating">
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                  </div>
                  <div class="product__price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <!-- Best Seller -->
          <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="trend__content">
              <div class="section-title">
                <h4>Best seller</h4>
              </div>
              @foreach($bestSeller as $product)
              <div class="trend__item">
                <div class="trend__item__pic">
                  <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('template-landing/img/trend/bs-1.jpg') }}" alt="" style="width: 90px; height: 90px; object-fit: cover; border-radius: 5px;"/>
                </div>
                <div class="trend__item__text">
                  <h6><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h6>
                  <div class="rating">
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                  </div>
                  <div class="product__price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <!-- Feature -->
          <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="trend__content">
              <div class="section-title">
                <h4>Feature</h4>
              </div>
              @foreach($feature as $product)
              <div class="trend__item">
                <div class="trend__item__pic">
                  <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('template-landing/img/trend/f-1.jpg') }}" alt="" style="width: 90px; height: 90px; object-fit: cover; border-radius: 5px;"/>
                </div>
                <div class="trend__item__text">
                  <h6><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h6>
                  <div class="rating">
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                  </div>
                  <div class="product__price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Trend Section End -->

    <!-- Discount Section Begin -->
    <section class="discount">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 p-0">
            <div class="discount__pic">
              <img src="{{ asset('template-landing/img/discount.jpg') }}" alt="" />
            </div>
          </div>
          <div class="col-lg-6 p-0">
            <div class="discount__text">
              <div class="discount__text__title">
                <span>Discount</span>
                <h2>Summer 2019</h2>
                <h5><span>Sale</span> 50%</h5>
              </div>
              <div class="discount__countdown" id="countdown-time">
                <div class="countdown__item">
                  <span>22</span>
                  <p>Days</p>
                </div>
                <div class="countdown__item">
                  <span>18</span>
                  <p>Hour</p>
                </div>
                <div class="countdown__item">
                  <span>46</span>
                  <p>Min</p>
                </div>
                <div class="countdown__item">
                  <span>05</span>
                  <p>Sec</p>
                </div>
              </div>
              <a href="#">Shop now</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Discount Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="services__item">
              <i class="fa fa-car"></i>
              <h6>Free Shipping</h6>
              <p>For all oder over $99</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="services__item">
              <i class="fa fa-money"></i>
              <h6>Money Back Guarantee</h6>
              <p>If good have Problems</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="services__item">
              <i class="fa fa-support"></i>
              <h6>Online Support 24/7</h6>
              <p>Dedicated support</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="services__item">
              <i class="fa fa-headphones"></i>
              <h6>Payment Secure</h6>
              <p>100% secure payment</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Services Section End -->

@endsection