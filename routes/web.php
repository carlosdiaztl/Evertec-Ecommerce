<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;


Route::get('/', [MainController::class, 'index'])->name('welcome');
Route::get('/product/{product}', [MainController::class, 'show'])->name('product.show');

// lmipiar cache
Route::get('/cache', function () {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    dd('cache clear');
});
Auth::routes(['verify' => true]);

// verificcion en rutas auth

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('verified',)->group(function () {
        Route::resource('users', AdminUserController::class)->names('users')->except('store')->middleware(['can:admin.users.index', 'can:admin.users.edit']);
        Route::resource('products', AdminProductController::class)->names('products')->middleware('can:admin.products.index');
        Route::post('products-store-excel',[ AdminProductController::class,'importExcel'])->name('products.store-excel');
        Route::resource('categories', CategoryController::class)->names('categories')->middleware('can:admin.products.index');
        Route::get('/home', [AdminHomeController::class, 'index'])->name('home');
        Route::get('users-pdf-export', [AdminUserController::class, 'exportPDF'])->name('users-pdf-export');
        Route::get('users-excel-export', [AdminUserController::class, 'exportExcel'])->name('users-excel-export');
        Route::get('products-pdf-export', [AdminProductController::class, 'exportPDF'])->name('products-pdf-export');
        Route::get('products-excel-export', [AdminProductController::class, 'exportExcel'])->name('products-excel-export');

    
    });
});

Route::middleware('verified')->group(function () {
    Route::get('/home', [MainController::class, 'index'])->name('home');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('orders/{user}', [OrderController::class,'index'])->name('orders.index');
    Route::post('payment/{order}', [PaymentController::class,'pay'])->name('payment.placetopay');

    // Route::resource('users', App\Http\Controllers\UserController::class)->names('admin.users')->except('store');
});
