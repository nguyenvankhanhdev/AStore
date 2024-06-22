<?php

use App\Http\Controllers\Auth\AuthenticateSessionController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Controllers\Backend\ProductController;
use App\Models\User;
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
// Product
Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
// caterogies
Route::get('categories/index', [CategoriesController::class, 'index'])->name('categories.index');
Route::get('categories/create', [CategoriesController::class, 'create'])->name('categories.create');




