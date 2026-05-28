<hr>
    <!-- Footer Section Begin -->
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-7">
            <div class="footer__about" style="font-family:'Inter', sans-serif;">
              <div class="footer__logo" style="margin-bottom:20px;">
                <a href="{{ route('home') }}" style="display:flex; align-items:center; gap:10px; text-decoration:none;">
                    <div style="width:36px; height:36px; border-radius:50%; border:2px solid #632c9b; display:flex; align-items:center; justify-content:center; background:#ffffff; color:#632c9b; font-family:'Cinzel', serif; font-weight:700; font-size:1.15rem;">R</div>
                    <div style="text-align:left;">
                        <div style="font-family:'Cinzel', serif; font-size:1.3rem; font-weight:700; color:#111111; letter-spacing:1px; line-height:1;">RANDO</div>
                        <div style="font-family:'Montserrat', sans-serif; font-size:0.58rem; font-weight:600; color:#666666; letter-spacing:3px; margin-top:2px; text-transform:uppercase;">PARFUM</div>
                    </div>
                </a>
              </div>
              <p style="font-size:0.9rem; color:#64748b; line-height:1.6; margin-bottom:20px;">
                Rando Parfum menghadirkan koleksi wewangian eksklusif original berkualitas tinggi yang dikurasi khusus untuk melengkapi karakter unik dan momen spesial Anda.
              </p>
              <div class="footer__payment">
                <a href="#"><img src="{{ asset('template-landing/img/payment/payment-1.png') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('template-landing/img/payment/payment-2.png') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('template-landing/img/payment/payment-3.png') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('template-landing/img/payment/payment-4.png') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('template-landing/img/payment/payment-5.png') }}" alt="" /></a>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-5">
            <div class="footer__widget" style="font-family:'Inter', sans-serif;">
              <h6>Tautan Cepat</h6>
              <ul>
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('shop') }}">Katalog Produk</a></li>
                <li><a href="{{ route('home') }}#cara-belanja">Cara Belanja</a></li>
                <li><a href="{{ route('home') }}#tentang-kami">Tentang Kami</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-2 col-md-3 col-sm-4">
            <div class="footer__widget" style="font-family:'Inter', sans-serif;">
              <h6>Akun Anda</h6>
              <ul>
                <li><a href="{{ route('transactions.index') }}">Pesanan Saya</a></li>
                <li><a href="{{ route('cart.index') }}">Keranjang Belanja</a></li>
                <li><a href="{{ route('checkout.index') }}">Checkout</a></li>
                @guest
                <li><a href="{{ route('login') }}">Masuk Akun</a></li>
                @else
                <li><a href="{{ route('transactions.index') }}">Profil Akun</a></li>
                @endguest
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-8 col-sm-8">
            <div class="footer__newslatter" style="font-family:'Inter', sans-serif;">
              <h6>NEWSLETTER</h6>
              <form action="#">
                <input type="text" placeholder="Masukkan Email" />
                <button type="submit" class="site-btn" style="background:#632c9b;">Subscribe</button>
              </form>
              <div class="footer__social">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-youtube-play"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-pinterest"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="footer__copyright__text" style="font-family:'Inter', sans-serif;">
              <p>
                Copyright &copy;
                <script>
                  document.write(new Date().getFullYear());
                </script>
                All rights reserved | Rando Parfum Toko Original
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
      <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
          <input type="text" id="search-input" placeholder="Search here....." />
        </form>
      </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{ asset('template-landing/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('template-landing/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template-landing/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('template-landing/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('template-landing/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('template-landing/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('template-landing/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('template-landing/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template-landing/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('template-landing/js/main.js') }}"></script>
  </body>
</html>
