<?php

namespace Bsdev\Ecommerce\Facades;

use Illuminate\Support\Facades\Facade;

class EcommerceFacade extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'ecommerce';
    }
}
