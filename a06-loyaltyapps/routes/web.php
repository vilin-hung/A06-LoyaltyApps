<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\RedeemController;

// Route Product - User biasa hanya bisa melihat daftar product dan detail product
Route::resource('products', ProductController::class)
    ->only(['index', 'show']);

// Route Product (Admin) - CRUD product hanya bisa dilakukan oleh user yang sudah login dan role admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', ProductController::class)
        ->except(['index', 'show']);
});

// Route Review - User dapat mengedit review miliknya,
// sedangkan admin memiliki hak untuk menghapus review (spam, SARA, dll)
Route::resource('reviews', ReviewController::class);
Route::resource('vouchers', VoucherController::class);
Route::middleware('auth')->group(function () {
    Route::get('/redeem', [RedeemController::class, 'create'])->name('redeem.create');
    Route::post('/redeem', [RedeemController::class, 'store'])->name('redeem.store');
    Route::get('/redeem/history', [RedeemController::class, 'history'])->name('redeem.history');
});
