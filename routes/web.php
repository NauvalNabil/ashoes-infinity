<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthRedirectController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use Illuminate\Support\Facades\Route;

// Homepage - User Product Listing
Route::get('/', [UserProductController::class, 'index'])->name('home');

// Redirect route after login
Route::get('/redirect', [AuthRedirectController::class, 'redirectAfterLogin'])
    ->middleware('auth')
    ->name('redirect.after.login');

// Guest Routes (Products for browsing)
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [UserProductController::class, 'index'])->name('index');
    Route::get('/{product}', [UserProductController::class, 'show'])->name('show');
    Route::get('/{product}/details', [UserProductController::class, 'getDetails'])->name('details');
});

// User Routes (Authenticated Users)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthRedirectController::class, 'redirectAfterLogin'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart Routes
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/', [CartController::class, 'store'])->name('store');
        Route::patch('/{cart}', [CartController::class, 'update'])->name('update');
        Route::delete('/{cart}', [CartController::class, 'destroy'])->name('destroy');
        Route::delete('/', [CartController::class, 'clear'])->name('clear');
        Route::get('/count', [CartController::class, 'getCartCount'])->name('count');
    });

    // User Order Routes
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [UserOrderController::class, 'index'])->name('index');
        Route::get('/create', [UserOrderController::class, 'create'])->name('create');
        Route::post('/', [UserOrderController::class, 'store'])->name('store');
        Route::get('/{order}', [UserOrderController::class, 'show'])->name('show');
        Route::post('/{order}/payment', [UserOrderController::class, 'uploadPayment'])->name('payment');
    });
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Admin Product Management
    Route::resource('products', AdminProductController::class);
    Route::patch('products/{product}/toggle-status', [AdminProductController::class, 'toggleStatus'])->name('products.toggle-status');
    
    // Admin Order Management
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
});

require __DIR__.'/auth.php';
