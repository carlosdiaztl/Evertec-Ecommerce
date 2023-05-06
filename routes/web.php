<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


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

// verificcion en rutas auth 
Auth::routes(['verify' => true]);


Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('verified',)->group(function () {
        Route::resource('users', AdminUserController::class)->names('users')->except('store')->middleware(['can:admin.users.index', 'can:admin.users.edit']);
        Route::resource('products', AdminProductController::class)->names('products')->middleware('can:admin.products.index');
        Route::get('/home', [AdminHomeController::class, 'index'])->name('home');
        Route::get('users-pdf-export', [AdminUserController::class, 'exportPDF'])->name('users-pdf-export');
        Route::get('users-excel-export', [AdminUserController::class, 'exportExcel'])->name('users-excel-export');

        // ruta admin products

        // Route::resource('product', ProductController::class)->names('products')->middleware(['admin.products.index']);
    });
});

Route::middleware('verified')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/{user}', [UserController::class, 'update'])->name('user.update');

    // Route::resource('users', App\Http\Controllers\UserController::class)->names('admin.users')->except('store');
});
