<?php

namespace Bsdev\Theme\Traits;

use Bsdev\Theme\Models\UserPermission;

trait HasPermission
{

    public function permission()
    {
        return $this->hasOne(UserPermission::class);
    }
}
