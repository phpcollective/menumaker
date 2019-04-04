<?php

use Illuminate\Database\Seeder;
use PhpCollective\MenuMaker\Storage\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Menu::class, 3)
            ->state('section')
            ->create()
            ->each(function ($section) {
                $section->children()->saveMany(factory(Menu::class, 10)->make());
                $section->descendants->each(function ($menu) {
                    $menu->children()->saveMany(
                        factory(Menu::class, mt_rand(1,9))->make()
                    );
                    $menu->descendants->each(function ($subMenu) {
                        $subMenu->children()->saveMany(
                            factory(Menu::class, mt_rand(1,5))->make()
                        );
                    });
                });
        });
    }
}
