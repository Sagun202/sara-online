<?php

namespace Bsdev\Slider\Traits;

trait FileUpload
{

    public function uploadFile($destination, $file)
    {
        return $file->store($destination, 'public');

    }
}
