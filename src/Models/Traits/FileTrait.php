<?php

namespace Ewvlnet\Dropzone\Models\Traits;

use Ewvlnet\Dropzone\Models\File;

trait FileTrait
{
    /**
     * @return mixed
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }
}