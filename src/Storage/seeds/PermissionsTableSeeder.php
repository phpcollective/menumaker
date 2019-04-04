<?php

use Illuminate\Database\Seeder;
use PhpCollective\MenuMaker\Storage\Menu;
use PhpCollective\MenuMaker\Storage\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::where('parent_id', '>', 0)->get()->each(function ($menu){
            $menu->permissions()->saveMany(factory(Permission::class, mt_rand(1,5))->make());
        });
    }
}
