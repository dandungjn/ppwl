<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class MenuHelper
{
    public static function buildSearchableMenus()
    {
        return collect(config('menu'))
            ->filter(fn($m) => $m['type'] !== 'header')
            ->map(function ($m) {
                if ($m['type'] === 'submenu') {
                    return collect($m['routes'])
                        ->map(function ($child) {
                            $routeName = $child['route'];
                            return [
                                'label' => $child['label'] ?? '',
                                'url' => Route::has($routeName) ? route($routeName) : '#',
                                'path' => Route::has($routeName) ? parse_url(route($routeName), PHP_URL_PATH) : '#',
                                'keywords' => strtolower($child['label'] ?? ''),
                            ];
                        })
                        ->toArray();
                }

                $routeName = str_replace('*', 'index', $m['route']);
                return [
                    [
                        'label' => $m['label'] ?? '',
                        'url' => Route::has($routeName) ? route($routeName) : '#',
                        'path' => Route::has($routeName) ? parse_url(route($routeName), PHP_URL_PATH) : '#',
                        'keywords' => strtolower($m['label'] ?? ''),
                    ],
                ];
            })
            ->flatten(1)
            ->filter(fn($m) => !empty($m['label']))
            ->values()
            ->toArray();
    }
}
