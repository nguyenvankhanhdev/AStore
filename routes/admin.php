<?php

use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoriesController;
use App\Http\Controllers\Backend\ProductImagesController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\VariantColorController;
use App\Http\Controllers\Backend\FlashSaleItemController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\DashboardController;

use App\Http\Controllers\Backend\ReportController;

use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\PaypalSettingController;

use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\FlashSaleController;


Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');

Route::resource('product', ProductController::class);

// ProductImageGallery
Route::resource('products-image-gallery', ProductImagesController::class);

Route::resource('dashboard', DashboardController::class);

Route::resource('categories', CategoriesController::class);

Route::resource('sub-categories', SubCategoriesController::class);

Route::resource('users', UserController::class);

Route::resource('products-variant', ProductVariantController::class);

Route::resource('variant-colors', VariantColorController::class);

Route::resource('comment', CommentController::class);

Route::get('reports', [ReportController::class, 'index'])->name('reports');



Route::get('reports/byCategory', [ReportController::class, 'reportByCategory'])->name('reports.byCategory');

Route::get('orders', [OrderController::class, 'index'])->name('orders');
Route::get('orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::delete('orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
Route::post('orders/status', [OrderController::class, 'changeOrderStatus'])->name('orders.status');
Route::get('orders-check', [OrderController::class, 'pendingOrders'])->name('orders.check');


Route::get('orders-pending', [OrderController::class, 'pendingOrder'])->name('orders.pending');
Route::get('orders-processed', [OrderController::class, 'processedOrders'])->name('orders.processed');
Route::get('orders-delivered', [OrderController::class, 'deliveredOrders'])->name('orders.delivered');
Route::get('orders-canceled', [OrderController::class, 'canceledOrders'])->name('orders.canceled');

Route::post('payment-status', [OrderController::class, 'changePaymentStatus'])->name('payment.status');




Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
Route::resource('paypal-setting', PaypalSettingController::class);

Route::get('message', [MessageController::class, 'index'])->name('message.index');

Route::post('message', [MessageController::class, 'store'])->name('message.store');

Route::post('message/changeStatus', [MessageController::class, 'changeStatus'])->name('message.changeStatus');

Route::get('message/newMessage', [MessageController::class, 'getNewMessages'])->name('message.getNewMessages');
Route::get('message/takeCountUnseenMessage', [MessageController::class, 'takeCountUnseenMessage'])->name('message.takeCountUnseenMessage');
Route::post('message/takeNewUserMessage', [MessageController::class, 'takeNewUserMessage'])->name('message.takeNewUserMessage');

//flash sale

Route::resource('flash-sale', FlashSaleController::class);
Route::put('flash-sale-status', [FlashSaleController::class, 'changeStatus'])->name('flash-sale-change-status');


//flash sale item
Route::post('flash-sale-item/add-categories', [FlashSaleItemController::class, 'addCategories'])->name('flash-sale-item.add-categories');
Route::get('flash-sale-item', [FlashSaleItemController::class, 'index'])->name('flash-sale-item.index');
Route::delete('flash-sale-item/{id}', [FlashSaleItemController::class, 'destroy'])->name('flash-sale-item.destroy');
Route::put('flash-sale-item-status', [FlashSaleItemController::class, 'changeStatus'])->name('flash-sale-item-status');
Route::put('flash-sale/show-at-home/status-change', [FlashSaleItemController::class, 'chageShowAtHomeStatus'])->name('flash-sale-item.show-at-home.change-status');
