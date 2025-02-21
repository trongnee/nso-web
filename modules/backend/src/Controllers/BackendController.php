<?php

namespace NSO\Backend\Controllers;

use Illuminate\Support\Facades\Cache;
use NSO\Backend\Theme\Menu;
use NSO\Models\Item;

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

    public function items()
    {
        $items = Cache::rememberForever('nso.items', function () {
            return Item::all()->keyBy('id');
        });
        return apiJson($items);
    }
}
