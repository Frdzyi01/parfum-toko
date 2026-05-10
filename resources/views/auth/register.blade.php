@extends('frontend.layout.app')
@section('title', 'Daftar - Parfum Toko')
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
                    <span>Daftar</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<section class="checkout spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="checkout__order" style="padding:40px;">
                    <h5 style="text-align:center; margin-bottom:30px;">Buat Akun Baru</h5>

                    @if($errors->any())
                        <div class="alert alert-danger" style="background:#fff0f0; border:1px solid #f5c6cb; border-radius:4px; padding:12px; margin-bottom:20px; color:#721c24;">
                            <i class="fa fa-exclamation-circle"></i>
                            <ul style="margin:0; padding-left:15px;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="checkout__form__input">
                            <p>Nama Lengkap <span>*</span></p>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   placeholder="Masukkan nama lengkap Anda" required autofocus>
                        </div>
                        <div class="checkout__form__input">
                            <p>Email <span>*</span></p>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   placeholder="Masukkan email Anda" required>
                        </div>
                        <div class="checkout__form__input">
                            <p>Password <span>*</span></p>
                            <input type="password" name="password"
                                   placeholder="Minimal 8 karakter" required>
                        </div>
                        <div class="checkout__form__input">
                            <p>Konfirmasi Password <span>*</span></p>
                            <input type="password" name="password_confirmation"
                                   placeholder="Ulangi password Anda" required>
                        </div>
                        <button type="submit" class="site-btn" style="width:100%; margin-top:10px;">Daftar</button>
                    </form>

                    <div style="text-align:center; margin-top:20px; color:#666;">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" style="color:#ca1515;">Masuk sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
