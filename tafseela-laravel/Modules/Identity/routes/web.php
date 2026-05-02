<?php

use Illuminate\Support\Facades\Route;
use Modules\Identity\Http\Controllers\AuthController;
use Modules\Identity\Http\Controllers\IdentityController;
use Modules\Identity\Http\Controllers\SocialAuthController;

// Public Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('signin', [AuthController::class, 'showSignIn'])->name('auth.signin');
    Route::post('signin', [AuthController::class, 'signIn']);
    
    Route::get('signup', [AuthController::class, 'showSignUp'])->name('auth.signup');
    Route::post('signup', [AuthController::class, 'signUp']);
    
    Route::get('terms', [AuthController::class, 'showTerms'])->name('auth.terms');
    Route::post('terms', [AuthController::class, 'acceptTerms']);
    
    Route::get('otp', [AuthController::class, 'showOtp'])->name('auth.otp');
    Route::post('otp', [AuthController::class, 'verifyOtp']);
    
    Route::get('recover-password', [AuthController::class, 'showRecoverPassword'])->name('auth.recover-password');
    Route::post('recover-password', [AuthController::class, 'recoverPassword']);
    
    Route::get('reset-password', [AuthController::class, 'showResetPassword'])->name('auth.reset-password');
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
});

// Protected Auth Routes (Post-Signup)
Route::middleware('auth')->group(function () {
    Route::get('profile-setup', [AuthController::class, 'showProfile'])->name('auth.profile');
    Route::post('profile-setup', [AuthController::class, 'storeProfile']);
    
    Route::get('location-setup', [AuthController::class, 'showLocation'])->name('auth.location');
    Route::post('location-setup', [AuthController::class, 'storeLocation']);
    
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Social Auth
Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])
    ->name('social.redirect')
    ->where('provider', 'google|facebook');

Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])
    ->name('social.callback')
    ->where('provider', 'google|facebook');

// Identity Management
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('identities', IdentityController::class)->names('identity');
});
