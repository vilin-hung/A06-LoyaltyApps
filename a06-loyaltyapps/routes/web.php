<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RedeemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;

// Home page redirects
Route::get('/', function () {
    return view('home');
})->middleware('auth')->name('home');

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

/*
    Guest Routes (Unauthenticated users only)
*/
Route::middleware('guest')->group(function () {
    // Authentication
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('show.login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    
    Route::get('signup', [AuthController::class, 'showSignupForm'])->name('show.signup');
    Route::post('signup', [AuthController::class, 'signup'])->name('signup.submit');
});

/*
    Authenticated Routes (Login dulu baru bisa akses)
*/
Route::middleware('auth')->group(function () {
    
    // Authentication
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    // Products Management
    Route::resource('products', ProductController::class);
    
    // Reviews Management
    Route::resource('reviews', ReviewController::class);
    
    // Vouchers Management
    Route::resource('vouchers', VoucherController::class);
    
});

/*
    Admin Routes (Wajib login dan wajib admin)
*/
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    
    // Halaman Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
});