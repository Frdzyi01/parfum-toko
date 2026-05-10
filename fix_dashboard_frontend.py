import re

file_path = "resources/views/frontend/dashboard.blade.php"
with open(file_path, "r") as f:
    content = f.read()

# Replace New Product Gallery
new_product_pattern = re.compile(r'<div class="row property__gallery">.*?</div>\n      </div>\n    </section>\n    <!-- Product Section End -->', re.DOTALL)
new_product_replacement = """<div class="row property__gallery">
          @forelse($newProducts as $product)
          <div class="col-lg-3 col-md-4 col-sm-6 mix">
            <div class="product__item">
              <div
                class="product__item__pic set-bg"
                data-setbg="{{ $product->image ? asset('storage/' . $product->image) : asset('template-landing/img/product/product-1.jpg') }}"
              >
                @if($loop->first)
                <div class="label new">New</div>
                @endif
                <ul class="product__hover">
                  <li>
                    <a href="{{ $product->image ? asset('storage/' . $product->image) : asset('template-landing/img/product/product-1.jpg') }}" class="image-popup"
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
    <!-- Product Section End -->"""

content = new_product_pattern.sub(new_product_replacement, content)

# Replace Trend Section
trend_pattern = re.compile(r'<div class="container">\n        <div class="row">\n          <div class="col-lg-4 col-md-4 col-sm-6">\n            <div class="trend__content">.*?</div>\n      </div>\n    </section>\n    <!-- Trend Section End -->', re.DOTALL)
trend_replacement = """<div class="container">
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
                  <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('template-landing/img/trend/ht-1.jpg') }}" alt="" style="width: 90px; height: 90px; object-fit: cover; border-radius: 5px;"/>
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
                  <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('template-landing/img/trend/bs-1.jpg') }}" alt="" style="width: 90px; height: 90px; object-fit: cover; border-radius: 5px;"/>
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
                  <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('template-landing/img/trend/f-1.jpg') }}" alt="" style="width: 90px; height: 90px; object-fit: cover; border-radius: 5px;"/>
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
    <!-- Trend Section End -->"""

content = trend_pattern.sub(trend_replacement, content)

with open(file_path, "w") as f:
    f.write(content)

print("Replacement done.")
