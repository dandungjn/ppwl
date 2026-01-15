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
    ['type' => 'item', 'route' => 'banks.*', 'label' => 'Bank', 'icon' => 'mdi-bank'],
    ['type' => 'item', 'route' => 'groups.*', 'label' => 'Group', 'icon' => 'mdi-account-group'],
    ['type' => 'item', 'route' => 'clients.*', 'label' => 'Client', 'icon' => 'mdi-account-multiple'],
    ['type' => 'item', 'route' => 'companies.*', 'label' => 'Company', 'icon' => 'mdi-office-building'],
    ['type' => 'item', 'route' => 'blogs.*', 'label' => 'Blog', 'icon' => 'mdi-book-open-page-variant'],
    ['type' => 'item', 'route' => 'positions.*', 'label' => 'Position', 'icon' => 'mdi-briefcase'],
    ['type' => 'item', 'route' => 'employees.*', 'label' => 'Employee', 'icon' => 'mdi-account-tie'],
    ['type' => 'item', 'route' => 'items.*', 'label' => 'Item', 'icon' => 'mdi-invoice-list'],
    ['type' => 'item', 'route' => 'expenses.*', 'label' => 'Expense', 'icon' => 'mdi-account-cash'],
    ['type' => 'item', 'route' => 'simple-searches.*', 'label' => 'Simple Search', 'icon' => 'mdi-magnify'],

    ['type' => 'header', 'title' => 'Documents & Letters'],
    ['type' => 'item', 'route' => 'quotations.*', 'label' => 'Quotation', 'icon' => 'mdi-file-document'],
    ['type' => 'item', 'route' => 'delivery-receipts.*', 'label' => 'Tanda Terima', 'icon' => 'mdi-truck-delivery'],
    ['type' => 'item', 'route' => 'job-orders.*', 'label' => 'Job Order', 'icon' => 'mdi-clipboard-list'],

    ['type' => 'header', 'title' => 'Configuration'],
    ['type' => 'item', 'route' => 'users.*', 'label' => 'User', 'icon' => 'mdi-account'],
    ['type' => 'item', 'route' => 'roles.*', 'label' => 'Role & Access', 'icon' => 'mdi-account-key'],

    [
        'type' => 'submenu',
        'title' => 'Settings',
        'icon' => 'mdi-cog',
        'routes' => [
            ['route' => 'profile.edit', 'label' => 'Profil Saya'],
        ],
    ],
];
