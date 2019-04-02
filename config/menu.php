<?php

return [

    'path' => 'menu-maker',
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
            'Auth'
        ],
        'controllers' => [
            'RoleController'
        ],
        'actions' => [
            'HomeController@index',
            'HomeController@show',
        ],
    ],
];
