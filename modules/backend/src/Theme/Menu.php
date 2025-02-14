<?php

namespace NSO\Backend\Theme;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use NSO\Backend\Facades\Theme;

class Menu
{
    public static $route_prefix = 'admin.';

    public static function render($sub = []): void
    {
        $menu = $sub ?: config('backend.menu');

        $actived = false;
        foreach ($menu as $item) {
            $item_classes = "menu-item";
            $url = self::getUrl($item);

            $active = static::isCanActive(Arr::get($item, 'route'));
            if ($active && !$actived) {
                $actived = true;
                $item_classes .= " active";
            }

            $children = Arr::get($item, 'children');

            if (static::checkChildActive($children)) {
                $item_classes .= " open";
            }
            echo view('backend::layout.components.menu', [
                ...$item,
                'item_classes' => $item_classes,
                'url' => $url,
                'children' => $children,
                'is_sub' => !empty($sub),
            ]);
        };
    }

    private static function checkChildActive($children): bool
    {
        if (!$children) {
            return false;
        }
        foreach ($children as $child) {
            if (static::isCanActive(Arr::get($child, 'route'))) {
                return true;
            }
        }
        return false;
    }
    private static function getUrl($item): string
    {
        $route_name = Arr::get($item, 'route');
        $url = 'javascript:void(0);';
        if (Arr::has($item, 'children') || !$route_name) {
            return $url;
        }

        return route(static::$route_prefix . $route_name);
    }

    private static function isCanActive($route_name): bool
    {
        $route = static::$route_prefix . $route_name;
        if ($route === Theme::getActiveMenu()) {
            return true;
        }
        return Route::currentRouteName() === static::$route_prefix . $route_name;
    }

    public static function flatMenu(array $menu = [])
    {
        $menu = $menu ?: config('backend.menu');
        $flattened = [];
        foreach ($menu as $item) {
            $currentItem = $item;
            unset($currentItem['children']);

            if (data_get($item, 'route')) {
                $flattened[] = [
                    'label' => data_get($item, 'label'),
                    'icon' => data_get($item, 'icon'),
                    'url' => route(static::$route_prefix . data_get($item, 'route')),
                ];
            }

            if (isset($item['children']) && is_array($item['children'])) {
                $flattened = array_merge(
                    $flattened,
                    static::flatMenu($item['children'])
                );
            }
        }
        return $flattened;
    }
}
