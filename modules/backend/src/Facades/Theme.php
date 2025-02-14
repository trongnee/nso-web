<?php

namespace NSO\Backend\Facades;

use Illuminate\Support\Facades\Facade;
use NSO\Backend\Theme\Theme as ThemeOriginal;

class Theme extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ThemeOriginal::class;
    }
}
