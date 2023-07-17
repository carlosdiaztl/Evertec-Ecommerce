<?php

use App\Http\Controllers\API\Admin\ProductController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\PublicProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Auth::routes(['verify' => true]);
Route::name('api-')->group(function(){

    Route::post('login', LoginController::class)->name('login');
    Route::post('register',RegisterController::class)->name('register');
});
Route::middleware('auth:sanctum','can:admin.products.index')->name('private')->group(function () {
    Route::resource('products', ProductController::class)->names('products');
    // aqui las rutas de productos 
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    if($request->user()->can('admin.users.index')) {
        return "autorizado";
    }
    return "No tiene este permiso";
});

Route::get('/public-products',[PublicProductController::class,'index'])->name('api.products');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
