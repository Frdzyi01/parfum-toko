<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\BerandaController;
use App\Http\Controllers\Frontend\ProdukController;
use App\Http\Controllers\Frontend\KeranjangController;
use App\Http\Controllers\Frontend\PemesananController;
use App\Http\Controllers\Frontend\TransaksiController;

use App\Http\Controllers\Auth\MasukController;
use App\Http\Controllers\Auth\DaftarController;
use App\Http\Controllers\Auth\LupaKataSandiController;
use App\Http\Controllers\Auth\ResetKataSandiController;
use App\Http\Controllers\Auth\KonfirmasiKataSandiController;
use App\Http\Controllers\Auth\VerifikasiController;

use App\Http\Controllers\Auth\AdminMasukController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminProdukController;
use App\Http\Controllers\Backend\AdminTransaksiController;

// ─────────────────────────────────────────────
// JALUR UMUM (PUBLIC ROUTES)
// ─────────────────────────────────────────────

// Beranda / Dashboard pelanggan
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// Katalog Toko
Route::get('/toko', [ProdukController::class, 'index'])->name('toko');

// Detail Produk
Route::get('/produk/{slug}', [ProdukController::class, 'tampilkan'])->name('produk.tampilkan');

// ─────────────────────────────────────────────
// JALUR AUTENTIKASI (AUTH ROUTES)
// ─────────────────────────────────────────────

// Masuk
Route::get('/masuk', [MasukController::class, 'showLoginForm'])->name('masuk');
Route::post('/masuk', [MasukController::class, 'login']);

// Keluar
Route::post('/keluar', [MasukController::class, 'logout'])->name('keluar');

// Daftar
Route::get('/daftar', [DaftarController::class, 'showRegistrationForm'])->name('daftar');
Route::post('/daftar', [DaftarController::class, 'register']);

// Lupa / Reset Kata Sandi
Route::get('/sandi/lupa', [LupaKataSandiController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/sandi/email', [LupaKataSandiController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/sandi/reset/{token}', [ResetKataSandiController::class, 'showResetForm'])->name('password.reset');
Route::post('/sandi/reset', [ResetKataSandiController::class, 'reset'])->name('password.update');

// Konfirmasi Kata Sandi
Route::get('/sandi/konfirmasi', [KonfirmasiKataSandiController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('/sandi/konfirmasi', [KonfirmasiKataSandiController::class, 'confirm']);

// Verifikasi Email
Route::get('/email/verifikasi', [VerifikasiController::class, 'show'])->name('verification.notice');
Route::get('/email/verifikasi/{id}/{hash}', [VerifikasiController::class, 'verify'])->name('verification.verify');
Route::post('/email/verifikasi/kirim-ulang', [VerifikasiController::class, 'resend'])->name('verification.resend');

// ─────────────────────────────────────────────
// JALUR DIJAGA (PROTECTED ROUTES)
// ─────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    // Keranjang
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::post('/keranjang/perbarui/{id}', [KeranjangController::class, 'perbarui'])->name('keranjang.perbarui');
    Route::delete('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

    // Pemesanan (Checkout)
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::post('/pemesanan/proses', [PemesananController::class, 'proses'])->name('pemesanan.proses');

    // Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/{invoice}', [TransaksiController::class, 'tampilkan'])->name('transaksi.tampilkan');
});

// ─────────────────────────────────────────────
// JALUR ADMIN
// ─────────────────────────────────────────────
Route::prefix('admin')->group(function () {
    Route::get('/masuk', [AdminMasukController::class, 'tampilkanFormMasuk'])->name('admin.masuk');
    Route::post('/masuk', [AdminMasukController::class, 'masuk'])->name('admin.masuk.kirim');
    Route::post('/keluar', [AdminMasukController::class, 'keluar'])->name('admin.keluar');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dasbor', [AdminController::class, 'index'])->name('admin.dasbor');

        // Manajemen Produk
        Route::get('/produk', [AdminProdukController::class, 'index'])->name('admin.produk.index');
        Route::get('/produk/buat', [AdminProdukController::class, 'buat'])->name('admin.produk.buat');
        Route::post('/produk', [AdminProdukController::class, 'simpan'])->name('admin.produk.simpan');
        Route::get('/produk/{produk}/ubah', [AdminProdukController::class, 'ubah'])->name('admin.produk.ubah');
        Route::put('/produk/{produk}', [AdminProdukController::class, 'perbarui'])->name('admin.produk.perbarui');
        Route::delete('/produk/{produk}', [AdminProdukController::class, 'hapus'])->name('admin.produk.hapus');

        // Manajemen Transaksi
        Route::get('/transaksi', [AdminTransaksiController::class, 'index'])->name('admin.transaksi.index');
        Route::get('/transaksi/{transaksi}', [AdminTransaksiController::class, 'tampilkan'])->name('admin.transaksi.tampilkan');
        Route::put('/transaksi/{transaksi}', [AdminTransaksiController::class, 'perbarui'])->name('admin.transaksi.perbarui');
    });
});
