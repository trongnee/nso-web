<?php

namespace NSO\Traits;

use Illuminate\Support\Facades\Route;

trait WithServiceProvider
{
    private function loadRoutes($path, $gurad = 'web')
    {
        if (!str_ends_with($path, '/')) {
            $path .= '/';
        }
        get_all_file($path, function ($route) use ($gurad) {

            Route::middleware([$gurad])
                ->group(function () use ($route) {
                    $this->loadRoutesFrom($route);
                });
        });
    }

    private function loadConfigs($path, $prefix)
    {
        get_all_file($path, function ($file) use ($prefix) {
            $this->mergeConfigFrom($file, $prefix . '.' . $file->getFilenameWithoutExtension());
        });
    }
}
