<?php
namespace Bsdev\Slider;

use Bsdev\Slider\Facades\Slider;
use Illuminate\Support\ServiceProvider;

class SliderServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'slider');
        $this->publishes([
            __DIR__ . '/public' => public_path('slider'),
        ], 'public');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');

    }

    public function register()
    {
        $this->app->bind('slider', function () {
            return new Slider;
        });
    }
}
