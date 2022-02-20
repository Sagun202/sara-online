<?php

namespace Bsdev\Slider\Traits;

use Theme;

trait CheckModule
{
    public function checkStatus()
    {

        if (!Theme::checkModuleStatus('Slider')) {
            return false;
        } else {
            return true;
        }
    }

}
