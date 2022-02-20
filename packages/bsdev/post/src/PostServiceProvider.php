<?php

namespace Bsdev\Post;

use Bsdev\Post\Facades\Post;
use Illuminate\Support\ServiceProvider;

class PostServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'post');
        $this->publishes([
            __DIR__ . '/public' => public_path('post'),
        ], 'public');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');

    }
    public function register()
    {
        $this->app->bind('post', function () {
            return new Post;
        });
    }

}
