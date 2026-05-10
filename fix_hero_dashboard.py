import re

file_path = "resources/views/frontend/dashboard.blade.php"
with open(file_path, "r") as f:
    content = f.read()

pattern = re.compile(r'<!-- Categories Section Begin -->.*?<!-- Categories Section End -->', re.DOTALL)

replacement = """<!-- Categories Section Begin -->
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
    <!-- Categories Section End -->"""

content = pattern.sub(replacement, content)

with open(file_path, "w") as f:
    f.write(content)

print("Replaced hero grid in dashboard.blade.php")
