<?php

use Illuminate\Support\Facades\Route;
use Modules\Cart\Http\Controllers\CartController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('carts', CartController::class)->names('cart');
    Route::post('carts/change-detail', [CartController::class, 'changeDetail'])->name('cart.change-detail');
});
