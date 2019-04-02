<?php

use Faker\Generator as Faker;
use PhpCollective\MenuMaker\Storage\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->state(Role::class, 'admin', [
    'is_admin' => true
]);

$factory->state(Role::class, 'inactive', [
    'is_active' => false
]);