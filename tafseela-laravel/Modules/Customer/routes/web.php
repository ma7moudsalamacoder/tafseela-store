<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\HomeController;
use Modules\Customer\Http\Controllers\NewsletterController;
use Modules\Customer\Http\Controllers\StorefrontController;

Route::get('/', HomeController::class)->name('home');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');

Route::get('/shop', [StorefrontController::class, 'index'])->name('shop');
Route::get('/new-arrivals', [StorefrontController::class, 'index'])->name('new-arrivals');
Route::get('/sale', [StorefrontController::class, 'index'])->name('sale');

Route::get('/category/{slug}', [StorefrontController::class, 'index'])->name('category');
Route::get('/product/{slug}', [StorefrontController::class, 'index'])->name('product');
Route::get('/collection/{slug}', [StorefrontController::class, 'index'])->name('collection');

Route::get('/cart', [StorefrontController::class, 'index'])->name('cart');
Route::get('/wishlist', [StorefrontController::class, 'index'])->name('wishlist');
Route::get('/account', [StorefrontController::class, 'index'])->name('account');
