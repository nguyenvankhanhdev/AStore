<?php

use App\Http\Controllers\Auth\AuthenticateSessionController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoriesController;
use App\Http\Controllers\Backend\ProductImagesController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

// Auth
Route::get('/', function () {
    return view('frontend.user.layouts.section_cate');
})->name('dashboard');

Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')
    ->middleware(RoleMiddleware::class . ':admin');

Route::get('admin', [AuthenticateSessionController::class, 'index'])
    ->name('auth.admin');


Route::post('login', [AuthenticateSessionController::class, 'store'])->name('auth.login');


Route::get('register', [RegisterUserController::class, 'create'])->name('auth.register');

Route::post('register', [RegisterUserController::class, 'store'])->name('auth.register.store');

Route::get('frontend/index', function () {
    return view('frontend.user.layouts.section_cate');
})->name('frontend.index')
  ->middleware(RoleMiddleware::class . ':user');

Route::post('logout', [AuthenticateSessionController::class, 'destroy'])
     ->name('auth.logout');


// Adminnnnn

// Product
Route::get('product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('product', ProductController::class);

// ProductImageGallery
Route::resource('products-image-gallery', ProductImagesController::class);


// caterogies
Route::resource('categories', CategoriesController::class);




// Sub_categories
Route::resource('sub-categories', SubCategoriesController::class);

Route::resource('users', UserController::class);

