<?php

use Bsdev\Vacancy\Controllers\VacancyApplicationController;
use Bsdev\Vacancy\Controllers\VacancyController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'backend'], function () {
    Route::resource('vacancies', VacancyController::class)->names('vacancies');
    Route::resource('vacancyapplications', VacancyApplicationController::class)->names('vacancyapplications');
});
