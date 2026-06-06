<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RedeemController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use App\Http\Middleware\AdminMiddleware;

/*
    Guest Routes (Belum Login)
*/
Route::middleware('guest')->group(function () {
    // Authentication
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    
    // Rate Limiting (keamanan)
    Route::post('login', [AuthController::class, 'login'])->name('login.submit')->middleware('throttle:5,1');
    
    Route::get('signup', [AuthController::class, 'showSignupForm'])->name('signup');
    Route::post('signup', [AuthController::class, 'signup'])->name('signup.submit');
});

/*
    Authenticated Routes (Wajib Login)
*/
Route::middleware('auth')->group(function () {
    // Home page redirects
    Route::get('/', function () {
        return view('home', ['user' => auth()->user()]);
    })->name('home');

    // Auth: User
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/change-password', [UserController::class, 'showChangePassword'])->name('change-password');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('change-password.submit');
    Route::get('/points', [UserController::class, 'points'])->name('points');
    Route::get('/saldo', [UserController::class, 'saldo'])->name('saldo');
    Route::post('/saldo/topup', [UserController::class, 'topup'])->name('saldo.topup');     

    // Auth: Logout 
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout.submit');

    // Carts
    Route::post('/checkout', [CartController::class, 'checkout'])->name('carts.checkout');
    Route::resource('carts', CartController::class);

    // Memberships
    // Route::resource('memberships', MembershipController::class);

    // News
    
    // Products
    Route::resource('products', ProductController::class);

    // Redeem Points
    Route::get('/redeem', [RedeemController::class, 'create'])->name('redeem.create');
    Route::post('/redeem', [RedeemController::class, 'store'])->name('redeem.store');
    Route::get('/redeem/history', [RedeemController::class, 'history'])->name('redeem.history');
    
    // Reviews
    Route::resource('reviews', ReviewController::class);

    // Transactions
    Route::get('/transactions/success', [TransactionController::class, 'success'])->name('transactions.success');
    Route::resource('transactions', TransactionController::class);

    // Vouchers
    Route::resource('vouchers', VoucherController::class);
});

/*
    Admin Routes (Wajib Login & Admin)
*/
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // Halaman Dashboard Admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::resource('memberships', MembershipController::class);
});