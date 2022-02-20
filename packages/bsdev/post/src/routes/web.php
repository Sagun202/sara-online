<?php

use Bsdev\Post\Controllers\CategoryController;
use Bsdev\Post\Controllers\PostCommentController;
use Bsdev\Post\Controllers\PostController;
use Bsdev\Post\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'checkstatus:Post'], 'prefix' => 'backend'], function () {

    Route::post('types-categories', [TypeController::class, 'getCategories'])->name('types.categories');
    Route::resource('types', TypeController::class)->names('types');
    Route::resource('categories', CategoryController::class)->names('categories');
    Route::post('posts-image', [PostController::class, 'uploadFileAjax'])->name('posts.image');
    Route::resource('posts', PostController::class)->names('posts');
    Route::resource('postcomment', PostCommentController::class)->names('postcomment');

});
