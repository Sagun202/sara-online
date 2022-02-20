<?php

namespace Bsdev\Vacancy\Facades;

use Theme;

class Vacancy
{
    public function getMenu()
    {

        if (!Theme::checkModuleStatus('Vacancy')) {
            return '';
        }
        return view('vacancy::menu');
    }
    public function getPermissions()
    {
        if (!Theme::checkModuleStatus('Vacancy')) {
            return [];
        }
        return [
            'vacancy_create',
            'vacancy_view',
            'vacancy_edit',
            'vacancy_update',
            'vacancy_delete',
            'vacancy_menu',
        ];
    }
}
