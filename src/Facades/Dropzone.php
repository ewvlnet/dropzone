<?php

namespace Ewvlnet\Dropzone\Facades;

use Illuminate\Support\Facades\Facade;

class Dropzone extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'dropzone';
    }
}