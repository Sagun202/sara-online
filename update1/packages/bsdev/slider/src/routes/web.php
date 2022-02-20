<?php

use Bsdev\Slider\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'checkstatus:Slider'], 'prefix' => 'backend'], function () {
    Route::resource('sliders', SliderController::class)->names('sliders');
});
