<?php
namespace Bsdev\Team\Traits;

trait FileUpload
{

    public function uploadFile($destination, $file)
    {
        return $file->store($destination, 'public');
    }
}
