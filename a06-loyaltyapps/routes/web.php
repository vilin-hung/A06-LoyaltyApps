<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedeemController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/redeem', [RedeemController::class, 'create'])->name('redeem.create');
    Route::post('/redeem', [RedeemController::class, 'store'])->name('redeem.store');
    Route::get('/redeem/history', [RedeemController::class, 'history'])->name('redeem.history');
});
