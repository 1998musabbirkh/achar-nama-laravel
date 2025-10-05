<?php

use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();

        return view('dashboard', compact('user'));
    })->name('dashboard');

    Route::resource('products', ProductController::class)->except(['show']);

    Route::resource('orders', OrderController::class)->only(['index', 'show', 'edit', 'update']);
});

Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');

Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);
