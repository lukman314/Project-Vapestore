<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SpkController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Pelanggan;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ── Public ────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [HomeController::class, 'catalog'])->name('catalog');
Route::get('/katalog/{product}', [HomeController::class, 'detail'])->name('product.detail');
Route::match(['get', 'post'], '/spk', [SpkController::class, 'index'])->name('spk');

// ── Auth ──────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ── Admin ─────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::resource('products', Admin\ProductController::class)->except(['show']);

    // Categories
    Route::get('/categories', [Admin\CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [Admin\CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [Admin\CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [Admin\CategoryController::class, 'destroy'])->name('categories.destroy');

    // Orders
    Route::get('/orders', [Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [Admin\OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/approve', [Admin\OrderController::class, 'approve'])->name('orders.approve');
    Route::post('/orders/{order}/reject', [Admin\OrderController::class, 'reject'])->name('orders.reject');

    // Users
    Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');

    // SPK Criteria
    Route::get('/spk', [Admin\SpkCriteriaController::class, 'index'])->name('spk.index');
    Route::post('/spk', [Admin\SpkCriteriaController::class, 'update'])->name('spk.update');
});

// ── Pelanggan ─────────────────────────────────────────────────────────────
Route::prefix('pelanggan')->name('pelanggan.')->middleware(['auth', 'pelanggan'])->group(function () {
    Route::get('/dashboard', [Pelanggan\DashboardController::class, 'index'])->name('dashboard');

    // Cart
    Route::get('/cart', [Pelanggan\CartController::class, 'index'])->name('cart');
    Route::post('/cart/{product}', [Pelanggan\CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cart}', [Pelanggan\CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart', [Pelanggan\CartController::class, 'clear'])->name('cart.clear');
    Route::delete('/cart/{cart}', [Pelanggan\CartController::class, 'remove'])->name('cart.remove');

    // Orders
    Route::get('/orders', [Pelanggan\OrderController::class, 'index'])->name('orders');
    Route::post('/checkout', [Pelanggan\OrderController::class, 'checkout'])->name('checkout');
    Route::get('/orders/{order}', [Pelanggan\OrderController::class, 'show'])->name('order.detail');

    // Edit Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// ── Kontak Kami ─────────────────────────────────────────────────────────────
Route::get('/kontak', function () {return view('home.kontak'); })
->name('kontak');