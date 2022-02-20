<?php

use Bsdev\Theme\Controllers\CMSController;
use Bsdev\Theme\Controllers\CssController;
use Bsdev\Theme\Controllers\DashboardController;
use Bsdev\Theme\Controllers\FaqController;
use Bsdev\Theme\Controllers\MenuController;
use Bsdev\Theme\Controllers\MessageController;
use Bsdev\Theme\Controllers\RoleController;
use Bsdev\Theme\Controllers\SettingController;
use Bsdev\Theme\Controllers\SiteController;
use Bsdev\Theme\Controllers\SubscriptionController;
use Bsdev\Theme\Controllers\TestimonialController;
use Bsdev\Theme\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'backend'], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->names('users');
    Route::resource('settings', SettingController::class)->names('settings');
    Route::resource('testimonials', TestimonialController::class)->names('testimonials');
    Route::get('mail', [SubscriptionController::class, 'mail'])->name('mail');
    Route::post('mail', [SubscriptionController::class, 'sendMail'])->name('mail.send');
    Route::resource('subscriptions', SubscriptionController::class)->names('subscriptions');
    Route::resource('cms', CMSController::class)->names('cms');
    Route::resource('menus', MenuController::class)->names('menus');
    Route::get('sites', [SiteController::class, 'index'])->name('sites.index');
    Route::post('sites', [SiteController::class, 'store'])->name('sites.store');
    Route::resource('roles', RoleController::class)->names('roles');
    Route::resource('faqs', FaqController::class)->names('faqs');
    Route::resource('messages', MessageController::class)->only('index', 'destroy')->names('messages');
    Route::resource('css', CssController::class)->only('index', 'store')->names('css');
    Route::get('update-profile', [UserController::class, 'editProfile'])->name('edit.vendorprofile');
    Route::post('update-profile', [UserController::class, 'updateProfile'])->name('update.vendorprofile');

});
