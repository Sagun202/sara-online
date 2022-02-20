<?php

namespace Bsdev\Vacancy;

use Bsdev\Vacancy\Facades\Vacancy;
use Illuminate\Support\ServiceProvider;

class VacancyServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'vacancy');
    }
    public function register()
    {
        $this->app->bind('Vacancy', function () {
            return new Vacancy;
        });
    }
}
