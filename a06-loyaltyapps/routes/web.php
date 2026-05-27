<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\RedeemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

Route::resource('products', ProductController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('vouchers', VoucherController::class);
// Route::middleware('auth')->group(function () {
// });