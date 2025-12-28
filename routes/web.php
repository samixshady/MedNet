<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\PrescriptionApprovalController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\PharmacyController;
use App\Http\Controllers\Shop\ShopAuthController;
use App\Http\Controllers\Shop\ShopDashboardController;
use App\Http\Controllers\Shop\ShopProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\QuickBuyController;
use App\Http\Controllers\SupportFeedbackController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Support Feedback Route (Public - no auth required)
Route::post('/support-feedback/store', [SupportFeedbackController::class, 'store'])->name('support-feedback.store');

Route::get('/dashboard', function () {
    $promotions = \App\Models\Promotion::where('is_active', true)
        ->orderBy('display_order')
        ->take(6)
        ->get();
    
    $discountedProducts = \App\Models\Product::where('discount', '>', 0)
        ->where('stock_status', '!=', 'out_of_stock')
        ->orderBy('discount', 'desc')
        ->take(20)
        ->get();
    
    return view('dashboard', ['promotions' => $promotions, 'discountedProducts' => $discountedProducts]);
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

    // Checkout routes
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/process-payment', [CheckoutController::class, 'processPayment'])->name('process-payment');
        Route::get('/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('confirmation');
        Route::get('/order-details/{order}', [CheckoutController::class, 'orderDetails'])->name('order-details');
        Route::post('/reduce-quantity/{orderItem}', [CheckoutController::class, 'reduceQuantity'])->name('reduce-quantity');
    });
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    Route::get('/profile/addresses', [ProfileController::class, 'addresses'])->name('profile.addresses');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Address routes
    Route::post('/addresses', [AddressController::class, 'store'])->name('addresses.store');
    Route::patch('/addresses/{address}', [AddressController::class, 'update'])->name('addresses.update');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');
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

        Route::get('analytics', [AnalyticsController::class, 'index'])
            ->name('analytics');

        Route::get('products/expired', [ProductController::class, 'expiredProducts'])
            ->name('products.expired');

        Route::resource('products', ProductController::class);

        // Promotions routes
        Route::prefix('promotions')->name('promotions.')->group(function () {
            Route::get('/', [PromoController::class, 'index'])->name('index');
            Route::post('/', [PromoController::class, 'store'])->name('store');
            Route::delete('/{promotion}', [PromoController::class, 'destroy'])->name('destroy');
            Route::post('/order', [PromoController::class, 'updateOrder'])->name('updateOrder');
        });

        // User Management routes
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserManagementController::class, 'index'])->name('index');
            Route::delete('/{user}', [UserManagementController::class, 'destroy'])->name('destroy');
            Route::post('/{user}/ban', [UserManagementController::class, 'ban'])->name('ban');
        });

        // Support Feedback routes
        Route::prefix('support-feedback')->name('support-feedback.')->group(function () {
            Route::get('/', [SupportFeedbackController::class, 'index'])->name('index');
            Route::post('/{feedback}/toggle-status', [SupportFeedbackController::class, 'toggleStatus'])->name('toggle-status');
            Route::post('/{feedback}/toggle-pin', [SupportFeedbackController::class, 'togglePin'])->name('toggle-pin');
            Route::post('/{feedback}/toggle-urgent', [SupportFeedbackController::class, 'toggleUrgent'])->name('toggle-urgent');
            Route::delete('/{feedback}', [SupportFeedbackController::class, 'destroy'])->name('destroy');
        });

        // Prescription Approval routes
        Route::prefix('prescriptions')->name('prescriptions.')->group(function () {
            Route::get('/', [PrescriptionApprovalController::class, 'index'])->name('index');
            Route::get('/{order}', [PrescriptionApprovalController::class, 'show'])->name('show');
            Route::post('/{order}/approve', [PrescriptionApprovalController::class, 'approve'])->name('approve');
            Route::post('/{order}/reject', [PrescriptionApprovalController::class, 'reject'])->name('reject');
            Route::get('/view/{orderItem}', [PrescriptionApprovalController::class, 'viewPrescription'])->name('view');
        });

        // Pharmacy Management routes
        Route::prefix('pharmacy')->name('pharmacy.')->group(function () {
            Route::get('/', [PharmacyController::class, 'index'])->name('index');
            Route::get('/create', [PharmacyController::class, 'create'])->name('create');
            Route::post('/', [PharmacyController::class, 'store'])->name('store');
            Route::post('/{id}/approve', [PharmacyController::class, 'approve'])->name('approve');
            Route::post('/{id}/reject', [PharmacyController::class, 'reject'])->name('reject');
            Route::post('/{id}/ban', [PharmacyController::class, 'ban'])->name('ban');
            Route::post('/{id}/unban', [PharmacyController::class, 'unban'])->name('unban');
            Route::delete('/{id}', [PharmacyController::class, 'destroy'])->name('destroy');
        });
    });
});

// Shop/Pharmacy Routes
Route::prefix('shop')->name('shop.')->group(function () {
    Route::middleware('guest:pharmacy')->group(function () {
        Route::get('login', [ShopAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [ShopAuthController::class, 'login'])->name('login.post');
        Route::get('register', [ShopAuthController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [ShopAuthController::class, 'register'])->name('register.post');
    });

    Route::middleware('auth:pharmacy')->group(function () {
        Route::post('logout', [ShopAuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [ShopDashboardController::class, 'index'])->name('dashboard');
        
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ShopProductController::class, 'index'])->name('index');
            Route::get('/create', [ShopProductController::class, 'create'])->name('create');
            Route::post('/', [ShopProductController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [ShopProductController::class, 'edit'])->name('edit');
            Route::put('/{id}', [ShopProductController::class, 'update'])->name('update');
            Route::delete('/{id}', [ShopProductController::class, 'destroy'])->name('destroy');
        });
    });
});

require __DIR__.'/auth.php';

