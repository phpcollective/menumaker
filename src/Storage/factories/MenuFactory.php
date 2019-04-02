<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use PhpCollective\MenuMaker\Storage\Menu;

$factory->define(Menu::class, function (Faker $faker) {
    return [
        'name'   => $faker->word,
        'alease' => $faker->unique()->slug,
        'routes' => implode(',', $faker->words()),
        'link'   => $faker->url,
        'icon'   => 'fa-' . Str::random(5),
        'class'  => Str::random(10)
    ];
});

$factory->state(Menu::class, 'section', function ($faker) {
    return [
        'name'   => $faker->word,
        'alease' => $faker->unique()->slug,
        'routes' => null,
        'link'   => null,
        'icon'   => null,
        'class'  => null
    ];
});

$factory->state(Menu::class, 'public', [
    'privilege' => 'PUBLIC'
]);

$factory->state(Menu::class, 'private', [
    'privilege' => 'PRIVATE'
]);

$factory->state(Menu::class, 'invisible', [
    'visible' => false
]);