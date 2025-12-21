<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/medicine', [ProductController::class, 'medicine'])->name('medicine');
    Route::get('/medicine/{id}', [ProductController::class, 'show'])->name('medicine.show');
    Route::get('/supplements', [ProductController::class, 'supplements'])->name('supplements');
    Route::get('/supplements/{id}', [ProductController::class, 'show'])->name('supplements.show');
    Route::get('/first-aid', [ProductController::class, 'firstAid'])->name('first-aid');
    Route::get('/first-aid/{id}', [ProductController::class, 'show'])->name('first-aid.show');
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

        Route::resource('products', ProductController::class);
    });
});

require __DIR__.'/auth.php';

