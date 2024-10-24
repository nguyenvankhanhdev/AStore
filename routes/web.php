<?php

use App\Http\Controllers\Auth\AuthenticateSessionController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\PaymentController;

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

Route::get('products', [ProductController::class, 'productsIndex'])->name('products.index');;

Route::get('frontend/category', function () {
    return view('frontend.user.categories.index');
});
Route::get('/', [ProductController::class, 'productsIndex'])->name('products.index');
Route::get('index', [ProductController::class, 'productsIndex'])->name('products.index');
Route::get('category', [ProductController::class, 'productCategories'])->name('products.category');

//details
Route::get('product/{slug}', [ProductController::class, 'showProduct'])->name('product.details');
Route::get('getPrice', [ProductController::class, 'getPrice'])->name('getPrice');




Route::get('subcategory', [ProductController::class, 'productSubCategories'])->name('products.subcategory');
Route::get('/get-districts/{province_id}', [CartController::class, 'getDistricts'])->name('get-districts');
Route::get('/get-wards/{district_id}', [CartController::class, 'getWards'])->name('get-wards');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.updateQuantity');

Route::get('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');

Route::get('remove-coupon', [CartController::class, 'removeCoupon'])->name('remove-coupon');

Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::resource('comments', CommentController::class);

Route::resource('comments', CommentController::class);
Route::post('comments/change-status', [CommentController::class, 'changeStatus'])->name('comments.change-status');
Route::post('comments/delete', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::post('comments/update', [CommentController::class, 'update'])->name('comments.update');
Route::post('comments/likeComment', [CommentController::class, 'likeComment'])->name('comments.likeComment');

// load lại tt giỏ hàng khi xóa discount
Route::get('reloadCart', [CartController::class, 'reloadCartDiscount'])->name('reloadCart');
Route::get('reloadCodeCoupon', [CartController::class, 'reloadCodeCoupon'])->name('reloadCodeCoupon');
// thanh toán





Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {

    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

// thanh toán paypal
    Route::post('paypal/payment',[PaymentController::class,'payment'])->name('paypal.payment');
    Route::get('paypal/success',[PaymentController::class,'success'])->name('paypal.success');
    Route::get('paypal/cancel',[PaymentController::class,'cancel'])->name('paypal.cancel');
// thanh toán COD
Route::post('payment/cod', [CheckOutController::class, 'checkOut'])->name('cod.store');



});
