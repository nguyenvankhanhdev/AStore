<?php

use App\Http\Controllers\Auth\AuthenticateSessionController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function() {

    Route::get('admin/login', [DashboardController::class, 'login']) ->name('admin.login');

    Route::get('register', [RegisterUserController::class, 'create'])->name('register');

    Route::get('login', [AuthenticateSessionController::class, 'index'])->name('login');

    Route::post('login', [AuthenticateSessionController::class, 'store']);

    Route::post('register', [RegisterUserController::class, 'store'])->name('register.store');
});




Route::middleware('auth')->group(function() {

    Route::post('logout', [AuthenticateSessionController::class, 'destroy'])
                ->name('logout');

});


