<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;

//Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', ProductController::class);
//});
    Route::resource('reviews', ReviewController::class);