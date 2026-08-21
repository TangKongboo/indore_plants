<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Customer\CustomerOrderController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\PlantController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;

use App\Http\Controllers\Storefront\PlantStoreController;
use App\Http\Controllers\Storefront\CartController;
use App\Http\Controllers\Storefront\CheckoutController;

use App\Http\Controllers\Storefront\CatalogController;

// -------------------------------------------------------------
// 🌿 Public Storefront Routes
// -------------------------------------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [CatalogController::class, 'index'])->name('shop');
Route::get('/plants/{slug}', [PlantStoreController::class, 'show'])->name('plant.show');
Route::get('/api/search', [CatalogController::class, 'apiSearch'])->name('api.search');

// Cart API Routes
Route::get('/cart', [CartController::class, 'getCart'])->name('cart.get');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');


// -------------------------------------------------------------
// 🔐 Authentication Routes (Guest Only)
// -------------------------------------------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout (Authenticated Only)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Authenticated Storefront Actions
Route::middleware('auth')->group(function () {
    Route::post('/plants/{plant}/reviews', [\App\Http\Controllers\Storefront\ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/wishlist/toggle', [\App\Http\Controllers\Storefront\WishlistController::class, 'toggle'])->name('wishlist.toggle');
});

// -------------------------------------------------------------
// 👤 Customer Account Routes (Protected by Auth)
// -------------------------------------------------------------
Route::middleware('auth')->prefix('account')->name('account.')->group(function () {
    Route::get('/orders', [CustomerOrderController::class, 'index'])->name('orders');
    Route::get('/wishlist', [\App\Http\Controllers\Storefront\WishlistController::class, 'index'])->name('wishlist');
});

// -------------------------------------------------------------
// 🛡️ Admin Management Routes (Protected by Auth & Admin Middleware)
// -------------------------------------------------------------
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('plants', PlantController::class);
    Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'destroy']);
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
});
