<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('dashboard/products', ProductController::class)->names('product');
});
