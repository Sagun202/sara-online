<?php

namespace App;

use Illuminate\Support\Facades\Facade;

class FrontEndHandlerFacade extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'frontendhandler';
    }
}
