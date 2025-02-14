<?php

namespace NSO\Backend\Controllers;

use NSO\Backend\Theme\Menu;

class BackendController
{
    public function index()
    {
        return view('backend::index');
    }

    public function search()
    {
        $menu = Menu::flatMenu();

        return apiJson([
            'menu' => $menu,
        ]);
    }
}
