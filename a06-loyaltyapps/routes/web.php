<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

//Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', ProductController::class);
//});
use App\Http\Controllers\PostController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\RedeemController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);
Route::resource('vouchers', VoucherController::class);
Route::middleware('auth')->group(function () {
    Route::get('/redeem', [RedeemController::class, 'create'])->name('redeem.create');
    Route::post('/redeem', [RedeemController::class, 'store'])->name('redeem.store');
    Route::get('/redeem/history', [RedeemController::class, 'history'])->name('redeem.history');
});
