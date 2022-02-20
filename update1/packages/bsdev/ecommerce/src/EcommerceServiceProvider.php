<?php

namespace Bsdev\Ecommerce;

use Bsdev\Ecommerce\Facades\Ecommerce;
use Bsdev\Ecommerce\Livewire\AttributeCreate;
use Bsdev\Ecommerce\Livewire\AttributeEdit;
use Bsdev\Ecommerce\Livewire\CustomField;
use Bsdev\Ecommerce\Livewire\CustomFieldEdit;
use Bsdev\Ecommerce\Livewire\ProductAttributeCreate;
use Bsdev\Ecommerce\Livewire\ProductAttributeEdit;
use Illuminate\Support\ServiceProvider;

class EcommerceServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'ecommerce');
        // $this->publishes([
        //     __DIR__ . '/public' => public_path(''),
        // ], 'public');
        // $router = $this->app->make(Router::class);
        // // $this->publishes([
        // //     __DIR__ . '/config/theme.php' => config_path('theme.php'),
        // // ], 'theme');
        // $router->aliasMiddleware('checkstatus', CheckStatus::class);
        \Livewire\Livewire::component('custom-field', CustomField::class);
        \Livewire\Livewire::component('custom-field-edit', CustomFieldEdit::class);
        \Livewire\Livewire::component('attribute-create', AttributeCreate::class);
        \Livewire\Livewire::component('attribute-edit', AttributeEdit::class);
        \Livewire\Livewire::component('product-attribute-create', ProductAttributeCreate::class);
        \Livewire\Livewire::component('product-attribute-edit', ProductAttributeEdit::class);

    }
    public function register()
    {
        $this->app->bind('ecommerce', function () {
            return new Ecommerce;
        });
    }
}
