<?php
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoriesController;
use App\Http\Controllers\Backend\ProductImagesController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\VariantColorController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::put('product/change-status', [ProductController::class, 'changeStatus'])->name('product.change-status');

Route::resource('product', ProductController::class);

// ProductImageGallery
Route::resource('products-image-gallery', ProductImagesController::class);
Route::resource('dashboard', DashboardController::class);

// caterogies
Route::resource('categories', CategoriesController::class);

// Sub_categories
Route::resource('sub-categories', SubCategoriesController::class);

Route::resource('users', UserController::class);

Route::resource('products-variant', ProductVariantController::class);

Route::resource('variant-colors', VariantColorController::class);

Route::resource('comment', CommentController::class);
