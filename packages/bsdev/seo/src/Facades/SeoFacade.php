<?php
namespace Bsdev\Seo\Facades;

use Illuminate\Support\Facades\Facade;

class SeoFacade extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'seo';
    }
}
