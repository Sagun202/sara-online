<?php

namespace Bsdev\Team\Facades;

use Illuminate\Support\Facades\Facade;

class TeamFacade extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'team';
    }
}
