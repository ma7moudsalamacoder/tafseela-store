<?php

use Illuminate\Support\Facades\Route;
use Modules\Identity\Http\Controllers\IdentityController;
use Modules\Identity\Http\Controllers\SocialAuthController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('identities', IdentityController::class)->names('identity');
});

Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])
    ->name('social.redirect')
    ->where('provider', 'google|facebook');

Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])
    ->where('provider', 'google|facebook');