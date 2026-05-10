@extends('frontend.layout.app')
@section('title', 'Login - Parfum Toko')
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                    <span>Login</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<section class="checkout spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="checkout__order" style="padding:40px;">
                    <h5 style="text-align:center; margin-bottom:30px;">Masuk ke Akun</h5>

                    @if($errors->any())
                        <div class="alert alert-danger" style="background:#fff0f0; border:1px solid #f5c6cb; border-radius:4px; padding:12px; margin-bottom:20px; color:#721c24;">
                            <i class="fa fa-exclamation-circle"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="checkout__form__input">
                            <p>Email <span>*</span></p>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   placeholder="Masukkan email Anda" required autofocus>
                        </div>
                        <div class="checkout__form__input">
                            <p>Password <span>*</span></p>
                            <input type="password" name="password"
                                   placeholder="Masukkan password Anda" required>
                        </div>
                        <div class="checkout__form__checkbox" style="margin-bottom:20px;">
                            <label for="remember">
                                Ingat saya
                                <input type="checkbox" name="remember" id="remember">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <button type="submit" class="site-btn" style="width:100%;">Masuk</button>
                    </form>

                    <div style="text-align:center; margin-top:20px; color:#666;">
                        Belum punya akun?
                        <a href="{{ route('register') }}" style="color:#ca1515;">Daftar sekarang</a>
                    </div>

                    @if(Route::has('password.request'))
                    <div style="text-align:center; margin-top:10px;">
                        <a href="{{ route('password.request') }}" style="color:#999; font-size:13px;">
                            Lupa password?
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
