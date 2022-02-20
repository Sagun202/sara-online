<?php

namespace Bsdev\Post\Facades;

use Illuminate\Support\Facades\Facade;

class PostFacade extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'post';
    }
}
