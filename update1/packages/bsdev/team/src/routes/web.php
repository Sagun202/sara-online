<?php

use Bsdev\Team\Controllers\DesignationController;
use Bsdev\Team\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth', 'checkstatus:Team'], 'prefix' => 'backend'], function () {
    Route::resource('designations', DesignationController::class)->names('designations');
    Route::resource('teams', TeamController::class)->names('teams');
});
