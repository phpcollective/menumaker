<?php

return [

    'path' => 'menu-maker',

    /*
    |--------------------------------------------------------------------------
    | Menu Maker Middleware Master Switch
    |--------------------------------------------------------------------------
    |
    | This option may be used to disable Menu Authorization Middleware check
    |
    */

    'enabled' => env('MENU_MIDDLEWARE_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Include Route List
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */
    'include' => [
        'namespaces' => [
            'App\Http\Controllers',
            'PhpCollective\MenuMaker\Http\Controllers'
        ],
        'controllers' => [

        ],
        'actions' => [

        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Exclude Route List
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'exclude' => [
        'namespaces' => [
            'App\Http\Controllers\Auth'
        ],
        'controllers' => [

        ],
        'actions' => [

        ],
    ],
];
