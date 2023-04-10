<?php

use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

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
    Route::middleware('verified')->group(function () {
        Route::resource('users', UserController::class)->names('users')->except('store')->middleware(['can:admin.users.index', 'can:admin.users.edit']);
        Route::get('/home', [AdminHomeController::class, 'index'])->name('home');
        Route::get('users-pdf-export', [UserController::class, 'exportPDF'])->name('users-pdf-export');
    });
});

Route::middleware('verified')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Route::resource('users', App\Http\Controllers\UserController::class)->names('admin.users')->except('store');
});
