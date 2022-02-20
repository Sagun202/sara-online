<?php

use Bsdev\Ecommerce\Controllers\AdvertisementController;
use Bsdev\Ecommerce\Controllers\AttributeController;
use Bsdev\Ecommerce\Controllers\BrandController;
use Bsdev\Ecommerce\Controllers\CategoryController;
use Bsdev\Ecommerce\Controllers\CustomFieldController;
use Bsdev\Ecommerce\Controllers\OrderController;
use Bsdev\Ecommerce\Controllers\ProductController;
use Bsdev\Ecommerce\Controllers\ProductReviewController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'backend/ecommerce'], function () {\
    Route::resource('categories', CategoryController::class)->names('product.categories');
    Route::resource('brands', BrandController::class)->names('brands');
    Route::post('image-upload', [ProductController::class, 'ajaxImageUpload'])->name('products.image');
    Route::get('product-imports', [ProductController::class, 'getBulkImport'])->name('product.import');
    Route::post('product-imports', [ProductController::class, 'bulkImport'])->name('products.import');
    Route::resource('products', ProductController::class)->names('products');
    Route::resource('product-reviews', ProductReviewController::class)->names('productreviews');
    Route::get('invoice/{order}', [OrderController::class, 'print'])->name('invoice');
    Route::resource('orders', OrderController::class)->names('orders')->only('index', 'edit', 'update', 'destroy');
    Route::resource('custom-fields', CustomFieldController::class)->names('custom-fields');
    Route::post('get-custom-fields', [ProductController::class, 'getCustomField'])->name('get-custom-fields');
    Route::resource('advertisements', AdvertisementController::class)->names('advertisements');
    Route::resource('attributes', AttributeController::class)->names('attributes');

});
