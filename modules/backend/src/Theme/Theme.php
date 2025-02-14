<?php

namespace NSO\Backend\Theme;

class Theme
{
    public ?string $menuActive = null;

    public function activeRouteMenu(string $routeName)
    {
        $this->menuActive = $routeName;
    }
    public function getActiveMenu()
    {
        return $this->menuActive;
    }
}
