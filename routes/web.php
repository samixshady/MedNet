<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
///All profile
Route::get('/user-profiles', [ProfileController::class, 'allProfiles'])->name('profile.all');


Route::post('/process-bkash-payment', [PaymentController::class, 'processBkashPayment'])->name('process_bkash_payment');

Route::get('/payment', function () {return view('payment');})->name('payment');
Route::get('/bkash', function () {return view('bkash');})->name('bkash');

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('homepage');
Route::get('/shop/{slug?}', [\App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/tag/{slug?}', [\App\Http\Controllers\ShopController::class, 'tag'])->name('shop.tag');
Route::get('/product/{product:slug}', [\App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

// react route
Route::get('products/{slug?}', [\App\Http\Controllers\ShopController::class, 'getProducts']);
Route::get('products', [\App\Http\Controllers\HomeController::class, 'getProducts']);
Route::get('product-detail/{product:slug}', [\App\Http\Controllers\ProductController::class, 'getProductDetail']);
Route::post('carts', [\App\Http\Controllers\CartController::class, 'store']);
Route::get('carts', [\App\Http\Controllers\CartController::class, 'showCart']);
// ongkir
Route::get('api/provinces', [\App\Http\Controllers\OngkirController::class, 'getProvinces']);
Route::get('api/cities', [\App\Http\Controllers\OngkirController::class, 'cities']);
Route::get('api/shipping-cost', [\App\Http\Controllers\OngkirController::class, 'shippingCost']);
Route::post('api/set-shipping', [\App\Http\Controllers\OngkirController::class, 'setShipping']);
Route::post('api/checkout', [\App\Http\Controllers\OrderController::class, 'checkout']);
// get user login
Route::get('api/users', [\App\Http\Controllers\UserController::class, 'index']);
// ==========
 

// routes/Profile

// routes/web.php
// routes/web.php

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/view', [ProfileController::class, 'view'])->name('profile.view'); // Add this line
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'save'])->name('profile.save');
});


// routes/web.php

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');



// routes/web.php


//Contact
Route::get('/contact', [ContactController::class, 'showContact'])->name('contact');

Route::group(['middleware' => 'auth'], function() {
    
    Route::get('/order/checkout', [\App\Http\Controllers\OrderController::class, 'process'])->name('checkout.process');
    Route::resource('/cart', \App\Http\Controllers\CartController::class)->except(['store', 'show']);

    Route::group(['middleware' => ['isAdmin'],'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
       
        // categories
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::post('categories/images', [\App\Http\Controllers\Admin\CategoryController::class,'storeImage'])->name('categories.storeImage');
    
        // tags
        Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);
    
        // products
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::post('products/images', [\App\Http\Controllers\Admin\ProductController::class,'storeImage'])->name('products.storeImage');
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
