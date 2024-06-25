<?php

use App\Http\Controllers\Auth\AuthenticateSessionController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoriesController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::get('/dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index')
    ->middleware(AuthenticateMiddleware::class);

Route::get('/admin', [AuthenticateSessionController::class, 'index'])
->name('auth.admin');

Route::get('/logout', [AuthenticateSessionController::class, 'logout'])
->name('auth.logout');

Route::post('/login', [AuthenticateSessionController::class, 'login'])
->name('auth.login');

// Adminnnnn
// Product\
Route::get('product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');
Route::resource('product', ProductController::class);

Route::resource('products-image-gallery', ProductImageGalleryController::class);


// caterogies
Route::resource('categories', CategoriesController::class);


Route::get('frontend/index',function(){
    return view('frontend.user.layouts.section_cate');
});

// Sub_categories
Route::resource('sub-categories', SubCategoriesController::class);

Route::resource('users', UserController::class);

