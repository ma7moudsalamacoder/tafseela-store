<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\CartQuickAddController;
use Modules\Customer\Http\Controllers\HomeController;
use Modules\Customer\Http\Controllers\NewsletterController;
use Modules\Customer\Http\Controllers\StorefrontController;
use Modules\Customer\Http\Controllers\WishlistController;

Route::get('/', HomeController::class)->name('home');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');

Route::get('/shop', [StorefrontController::class, 'getShop'])->name('shop');
Route::get('/sale', [StorefrontController::class, 'getSale'])->name('sale');
Route::get('/new-arrivals', [StorefrontController::class, 'getNewArrival'])->name('new-arrivals');
Route::get('/search', [StorefrontController::class, 'getSearch'])->name('search');

Route::get('/category/{slug}', [StorefrontController::class, 'index'])->name('category');
Route::get('/product/{id}', [StorefrontController::class, 'getProductDetails'])->name('product-detail')->where('id', '[0-9]+');
Route::get('/product/{slug}', [StorefrontController::class, 'index'])->name('product');
Route::get('/collection/{slug}', [StorefrontController::class, 'getCollection'])->name('collection');

Route::get('/cart', [StorefrontController::class, 'index'])->name('cart');
Route::get('/wishlist', [StorefrontController::class, 'index'])->name('wishlist');
Route::get('/account', [StorefrontController::class, 'index'])->name('account');

Route::get('/category', function () {
    return view('customer::category');
});

Route::post('/cart/quick-add', CartQuickAddController::class)->name('customer.cart.quick-add');
Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('customer.wishlist.toggle');
Route::get('/wishlist/items', [WishlistController::class, 'items'])->name('customer.wishlist.items');
