<?php
namespace Bsdev\Slider\Facades;

use Bsdev\Slider\Models\Slider as Slide;
use Bsdev\Slider\Traits\CheckModule;
use Theme;

class Slider
{
    use CheckModule;

    public function getSliders()
    {
        if (!Theme::checkModuleStatus('Slider')) {
            return [];
        }
        return Slide::where('status', 1)->get();
    }

    public function getSliderQuery()
    {

        if (!Theme::checkModuleStatus('Slider')) {
            return null;
        }

        return Slide::query();
    }

    public function getMenu()
    {
        if (!Theme::checkModuleStatus('Slider')) {
            return false;
        }

        if (!auth()->user()->can('slider_menu')) {

            return '';
        }

        $view = view('slider::menu')->render();
        return $view;

    }

    public function getPermissions()
    {

        if (!Theme::checkModuleStatus('Slider')) {
            return false;
        }

        return [
            'slider_menu',
            'slider_create',
            'slider_edit',
            'slider_delete',
            'slider_view',
            'slider_update',
        ];
    }

}
