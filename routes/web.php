<?php

use App\Http\Controllers\Auth\AuthenticateSessionController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\FrontendCartController;
use App\Http\Controllers\Frontend\FrontendProductController;

use Illuminate\Support\Facades\Route;

// Auth


Route::get('dashboard/index', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('admin', [AuthenticateSessionController::class, 'index'])
    ->name('auth.admin');


Route::post('login', [AuthenticateSessionController::class, 'store'])->name('auth.login');

Route::get('login', [AuthenticateSessionController::class, 'index'])->name('auth.login.web');

Route::get('register', [RegisterUserController::class, 'create'])->name('auth.register');

Route::post('register', [RegisterUserController::class, 'store'])->name('auth.register.store');

// Route::get('frontend/index', function () {
//     return view('frontend.user.layouts.section_cate');
// })->name('frontend.index');

Route::post('logout', [AuthenticateSessionController::class, 'destroy'])
    ->name('auth.logout');

//frontend

Route::get('products', [FrontendProductController::class, 'productsIndex'])->name('products.index');;

Route::get('frontend/category', function () {
    return view('frontend.user.categories.index');
});
Route::get('/', [FrontendProductController::class, 'productsIndex'])->name('products.index');
Route::get('index', [FrontendProductController::class, 'productsIndex'])->name('products.index');
Route::get('category', [FrontendProductController::class, 'productCategories'])->name('products.category');

//details
Route::get('product/{slug}', [FrontendProductController::class, 'showProduct'])->name('product.details');

Route::get('subcategory', [FrontendProductController::class, 'productSubCategories'])->name('products.subcategory');
Route::get('/get-districts/{province_id}', [FrontendCartController::class, 'getDistricts'])->name('get-districts');
Route::get('/get-wards/{district_id}', [FrontendCartController::class, 'getWards'])->name('get-wards');
Route::get('/cart', [FrontendCartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [FrontendCartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [FrontendCartController::class, 'update'])->name('cart.updateQuantity');

Route::get('apply-coupon', [FrontendCartController::class, 'applyCoupon'])->name('apply-coupon');

Route::delete('/cart/{id}', [FrontendCartController::class, 'destroy'])->name('cart.destroy');

Route::resource('comments', CommentController::class);





Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {

    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
});
Route::post('/cart/select-color', [FrontendCartController::class, 'selectColor'])->name('cart.selectColor');
