<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\HomeController;
use Modules\Customer\Http\Controllers\NewsletterController;
use Modules\Customer\Http\Controllers\StorefrontController;

Route::get('/', HomeController::class)->name('customer.home');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'store'])->name('newsletter.subscribe');

Route::get('/products', [StorefrontController::class, 'products'])->name('customer.products.index');
Route::get('/products/{slug}', [StorefrontController::class, 'product'])->name('customer.products.show');
Route::get('/sections/{slug}', [StorefrontController::class, 'section'])->name('customer.sections.show');
Route::get('/checkout', [StorefrontController::class, 'checkout'])->name('customer.checkout');
Route::get('/order/completed', [StorefrontController::class, 'orderCompleted'])->name('customer.orders.completed');
Route::get('/order/tracking', [StorefrontController::class, 'orderTracking'])->name('customer.orders.tracking');

Route::redirect('/category/{slug}', '/sections/{slug}')->name('customer.category');
