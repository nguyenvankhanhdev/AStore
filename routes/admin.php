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

use App\Http\Controllers\Backend\ProductSupportController;

use App\Http\Controllers\Backend\WarehouseController;
use App\Http\Controllers\Backend\WarehouseDetailController;


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

Route::get('product-variants/{product}', [ProductVariantController::class, 'getVariantsByProduct'])->name('product.variants.get');

Route::get('variant-colors-by-variant/{variant}', [VariantColorController::class, 'getColorsByVariant'])->name('variant.colors.get');

Route::get('/api/get-variant-color/{variant_id}/{color_id}', [VariantColorController::class, 'getVariantColor'])->name('api.variant.color.get');


Route::resource('products-variant', ProductVariantController::class);

Route::resource('variant-colors', VariantColorController::class);




Route::resource('comment', CommentController::class);

Route::resource('comment', CommentController::class);

// Điền use for product - support another sub_category route
Route::get('product-support', [ProductSupportController::class, 'index'])->name('product-support.index');
Route::post('product-support-create', [ProductSupportController::class, 'store'])->name('product-support.store');
Route::post('product-support-destroy', [ProductSupportController::class, 'destroy'])->name('product-support.destroy');

Route::get('reports', [ReportController::class, 'index'])->name('reports');
Route::get('best-products', [ProductController::class, 'bestProducts'])->name('best-products');
Route::get('top-products', [ProductController::class, 'topProducts'])->name('top-products');

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
Route::get('orders-completed', [OrderController::class, 'completedOrders'])->name('orders.completed');

Route::post('payment-status', [OrderController::class, 'changePaymentStatus'])->name('payment.status');

Route::get('warehouse', [WarehouseController::class, 'index'])->name('warehouse');
Route::get('warehouse/{id}', [WarehouseDetailController::class, 'index'])->name('warehouse.show');

Route::get('warehouse-import', [WarehouseController::class, 'createImport'])->name('warehouse.create');
Route::post('warehouse-import', [WarehouseController::class, 'storeImport'])->name('warehouse.store');


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

Route::get('user-list', [UserController::class, 'index'])->name('user-list');
Route::get('admin-list', [UserController::class, 'admin'])->name('admin-list');
