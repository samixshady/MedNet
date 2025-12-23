<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\QuickBuyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/medicine', [ProductController::class, 'medicine'])->name('medicine');
    Route::get('/medicine/{id}', [ProductController::class, 'show'])->name('medicine.show');
    Route::get('/supplements', [ProductController::class, 'supplements'])->name('supplements');
    Route::get('/supplements/{id}', [ProductController::class, 'show'])->name('supplements.show');
    Route::get('/first-aid', [ProductController::class, 'firstAid'])->name('first-aid');
    Route::get('/first-aid/{id}', [ProductController::class, 'show'])->name('first-aid.show');
    
    // QuickBuy routes
    Route::prefix('quick-buy')->name('quick-buy.')->group(function () {
        Route::get('/manage', [QuickBuyController::class, 'manage'])->name('manage');
        Route::get('/items', [QuickBuyController::class, 'getItems'])->name('items');
        Route::post('/add', [QuickBuyController::class, 'add'])->name('add');
        Route::post('/{quickBuyId}/remove', [QuickBuyController::class, 'remove'])->name('remove');
        Route::patch('/{quickBuyId}/quantity', [QuickBuyController::class, 'updateQuantity'])->name('updateQuantity');
    });
    
    // Cart routes
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add', [CartController::class, 'add'])->name('add');
        Route::patch('/{cartItemId}/quantity', [CartController::class, 'updateQuantity'])->name('updateQuantity');
        Route::post('/{cartItemId}/prescription', [CartController::class, 'uploadPrescription'])->name('uploadPrescription');
        Route::delete('/{cartItemId}', [CartController::class, 'remove'])->name('remove');
        Route::get('/count', [CartController::class, 'count'])->name('count');
        Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
    });
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AdminAuthenticatedSessionController::class, 'store'])->name('login.store');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('logout');
        
        Route::get('dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('products/expired', [ProductController::class, 'expiredProducts'])
            ->name('products.expired');

        Route::resource('products', ProductController::class);
    });
});

require __DIR__.'/auth.php';

