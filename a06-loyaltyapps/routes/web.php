<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\RedeemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MembershipController;

Route::resource('products', ProductController::class);
Route::resource('reviews', ReviewController::class);
Route::resource('vouchers', VoucherController::class);
Route::resource('memberships', MembershipController::class);
Route::middleware('auth')->group(function () {
    Route::get('/redeem', [RedeemController::class, 'create'])->name('redeem.create');
    Route::post('/redeem', [RedeemController::class, 'store'])->name('redeem.store');
    Route::get('/redeem/history', [RedeemController::class, 'history'])->name('redeem.history');
  
    Route::get('/transactions/success', [TransactionController::class, 'success'])->name('transactions.success');
    Route::get('/transactions/history', [TransactionController::class, 'history'])->name('transactions.history');
    Route::resource('transactions', TransactionController::class);
});
