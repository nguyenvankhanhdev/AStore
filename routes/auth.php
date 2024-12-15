<?php

use App\Http\Controllers\Auth\AuthenticateSessionController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterUserController::class, 'create'])->name('register');

    Route::get('login', [AuthenticateSessionController::class, 'index'])->name('login');

    Route::post('login', [AuthenticateSessionController::class, 'store']);

    Route::post('register', [RegisterUserController::class, 'store'])->name('register.store');
    Route::get('auth/google', [AuthenticateSessionController::class, 'redirect'])->name('auth.google');
    Route::get('auth/google/callback', [AuthenticateSessionController::class, 'callBackGoogle'])->name('auth.google.callback');

    Route::get('auth/github', [AuthenticateSessionController::class, 'redirectToGithub'])->name('auth.github');
    Route::get('auth/github/callback', [AuthenticateSessionController::class, 'handleGithubCallback'])->name('auth.github.callback');
    Route::post('/password/verify-otp', [AuthenticateSessionController::class, 'resetPassword'])->name('password.verify-otp');
    Route::post('/password/forgot', [AuthenticateSessionController::class, 'sendOtp'])->name('password.forgot');

});




Route::middleware('auth')->group(function () {

    Route::post('logout', [AuthenticateSessionController::class, 'destroy'])
        ->name('logout');
});
