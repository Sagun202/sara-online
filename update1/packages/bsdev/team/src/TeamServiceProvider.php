<?php

namespace Bsdev\Team;

use Bsdev\Team\Facades\Team;
use Illuminate\Support\ServiceProvider;

class TeamServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'team');
        $this->publishes([
            __DIR__ . '/public' => public_path('team'),
        ], 'public');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');

    }
    public function register()
    {
        $this->app->bind('team', function () {
            return new Team;
        });
    }

}
