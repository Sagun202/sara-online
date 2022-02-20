<?php

use App\Http\Controllers\FrontEndController;
use Illuminate\Support\Facades\Route;
Route::resource('vendor','VendorController');


Route::get('/', [FrontEndController::class, 'index'])->name('index');
Route::get('/search', [FrontEndController::class, 'search'])->name('search');
Route::get('products/{slug}', [FrontEndController::class, 'productDetail'])->name('product.detail');
Route::get('category/{slug}', [FrontEndController::class, 'category'])->name('category');
Route::get('blogs/{slug}', [FrontEndController::class, 'blog_detail'])->name('blogs');
Route::get('blog_list', [FrontEndController::class, 'blog_list'])->name('blog_list');
Route::get('categories', [FrontEndController::class, 'categories'])->name('categories');
Route::get('brand/{slug}', [FrontEndController::class, 'brand'])->name('brand'); 
Route::get('product-list/{slug}', [FrontEndController::class, 'productList'])->name('product.list');
Route::get('cart', [FrontEndController::class, 'cart'])->name('cart');
Route::get('help-center', [FrontEndController::class, 'help'])->name('help');
Route::get('search-suggestion', [FrontEndController::class, 'searchSuggestion'])->name('search-suggestion');
Route::get('privacy', [FrontEndController::class, 'privacy'])->name('privacy');
Route::get('terms-of-sale', [FrontEndController::class, 'termsOfSale'])->name('terms-of-sale');
Route::get('terms-of-use', [FrontEndController::class, 'termsOfUse'])->name('terms-of-use');
Route::get('warranty', [FrontEndController::class, 'warranty'])->name('warranty');
Route::get('about', [FrontEndController::class, 'about'])->name('about');
Route::get('/vendor', [FrontEndController::class, 'vendor'])->name('vendor');

Route::get('sell-with-us', [FrontEndController::class, 'sell'])->name('sell-us');
Route::get('jobs/{slug}', [FrontEndController::class, 'jobDetail'])->name('jobs.detail');
Route::group(['middleware' => 'auth'], function () {

    Route::get('checkout', [FrontEndController::class, 'checkout'])->name('checkout');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/dashboard', [FrontEndController::class, 'userDashboard'])->name('user.dashboard');
        Route::get('wishlists', [FrontEndController::class, 'wishLists'])->name('user.wishlists');
        Route::delete('wishlists/{wishlist}', [FrontEndController::class, 'removeWishList'])->name('user.wishlist.remove');
    });
});
