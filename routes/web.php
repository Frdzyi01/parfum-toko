<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\TransactionController;

// ─────────────────────────────────────────────
// PUBLIC ROUTES
// ─────────────────────────────────────────────

// Home / Dashboard
Route::get('/', function () {
    return view('frontend.dashboard');
})->name('home');

// Shop Catalog
Route::get('/shop', [ProductController::class, 'index'])->name('shop');

// Product Detail
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// ─────────────────────────────────────────────
// AUTH ROUTES (Login, Register, Logout)
// ─────────────────────────────────────────────
Auth::routes();

// ─────────────────────────────────────────────
// PROTECTED ROUTES (Auth Required)
// ─────────────────────────────────────────────

// Cart
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{invoice}', [TransactionController::class, 'show'])->name('transactions.show');
});

// ─────────────────────────────────────────────
// ADMIN ROUTES
// ─────────────────────────────────────────────
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminProductController;
use App\Http\Controllers\Backend\AdminTransactionController;

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // Catalog Management
        Route::resource('products', AdminProductController::class)->names('admin.products');

        // Order/Transaction Management
        Route::resource('transactions', AdminTransactionController::class)->only(['index', 'show', 'update'])->names('admin.transactions');
    });
});
