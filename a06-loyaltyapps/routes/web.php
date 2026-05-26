<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

//Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('products', ProductController::class);
//});
