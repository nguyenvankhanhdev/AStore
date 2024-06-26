<?php

use App\Http\Controllers\Auth\AuthenticateSessionController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoriesController;
use App\Http\Controllers\Backend\ProductImagesController;
use App\Http\Controllers\Frontend\FrontendProductController;

use Illuminate\Support\Facades\Route;

// Auth
Route::get('/', function () {
    return view('frontend.user.layouts.section_cate');
})->name('dashboard');

Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('admin', [AuthenticateSessionController::class, 'index'])
    ->name('auth.admin');


Route::post('login', [AuthenticateSessionController::class, 'store'])->name('auth.login');


Route::get('register', [RegisterUserController::class, 'create'])->name('auth.register');

Route::post('register', [RegisterUserController::class, 'store'])->name('auth.register.store');

Route::get('frontend/index', function () {
    return view('frontend.user.layouts.section_cate');
})->name('frontend.index');

Route::post('logout', [AuthenticateSessionController::class, 'destroy'])
     ->name('auth.logout');
     
//frontend
Route::get('products', [FrontendProductController::class, 'productsIndex'])->name('products.index');;
