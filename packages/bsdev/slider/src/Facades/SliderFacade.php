<?php

namespace Bsdev\Slider\Facades;

use Illuminate\Support\Facades\Facade;

class SliderFacade extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'slider';
    }
}
