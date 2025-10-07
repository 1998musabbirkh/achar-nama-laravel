<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');


Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('blog.show');

Route::get('/track/order', [OrderController::class, 'track'])->name('order.track');
Route::post('/track/order/details', [OrderController::class, 'trackDetails'])->name('order.track.details');

// Google Authentication Routes
Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

// Admin Protected Routes
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', function () {
            $user = Auth::user();

            return view('dashboard', compact('user'));
        })->name('dashboard');

        Route::resource('products', ProductController::class)->except(['show']);
        Route::resource('orders', OrderController::class)->only(['index', 'show', 'edit', 'update']);

        Route::resource('posts', AdminPostController::class)->names('admin.posts');
    });
