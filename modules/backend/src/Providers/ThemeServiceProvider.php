<?php

namespace NSO\Backend\Providers;

use Illuminate\Support\ServiceProvider;
use NSO\Backend\Theme\Theme;

class ThemeServiceProvider extends ServiceProvider
{
  public function boot() {}

  public function register()
  {
    $this->app->singleton(Theme::class, function () {
      return new Theme();
    });
  }
}
