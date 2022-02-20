<?php

namespace Bsdev\Vacancy\Facades;

use Illuminate\Support\Facades\Facade;

class VacancyFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'vacancy';
    }
}
