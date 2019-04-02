<?php


/*
|--------------------------------------------------------------------------
| Permission Factory
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

use PhpCollective\MenuMaker\Storage\Permission;

$factory->define(Permission::class, function () {
    $permission = Permission::routes()->random();
    return [
        'namespace'  => $permission['namespace'],
        'controller' => $permission['controller'],
        'method'     => $permission['method'],
        'action'     => $permission['action']
    ];
});
