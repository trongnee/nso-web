<?php

namespace NSO\Backend\Providers;

use Illuminate\Support\ServiceProvider;
use NSO\Traits\WithServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
  use WithServiceProvider;

  private const ROOT_PATH = __DIR__ . '/../../';

  public function boot()
  {
    $this->loadRoutes(self::ROOT_PATH . 'routes');
    $this->loadConfigs(self::ROOT_PATH . 'config/', 'backend');
    $this->loadViewsFrom(self::ROOT_PATH . 'views/', 'backend');
  }
}
