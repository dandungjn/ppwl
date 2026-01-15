<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menu Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the menu items for your application. This file
    | contains an array of menu items that will be used to build the sidebar
    | navigation in your application.
    |
    */

    ['type' => 'header', 'title' => 'Main Menu'],

    ['type' => 'item', 'route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'mdi-view-dashboard'],

    ['type' => 'header', 'title' => 'Master Data'],
    ['type' => 'item', 'route' => 'categories.*', 'label' => 'Category', 'icon' => 'mdi-shape'],
    ['type' => 'item', 'route' => 'furniture.*', 'label' => 'Furniture', 'icon' => 'mdi-sofa'],
    ['type' => 'item', 'route' => 'orders.*', 'label' => 'Order', 'icon' => 'mdi-cart'],

    // [
    //     'type' => 'submenu',
    //     'title' => 'Settings',
    //     'icon' => 'mdi-cog',
    //     'routes' => [
    //         ['route' => 'profile.edit', 'label' => 'Profil Saya'],
    //     ],
    // ],
];
