<?php

use Illuminate\Database\Seeder;
use PhpCollective\MenuMaker\Storage\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Role::class, 10)->create();
        factory(Role::class, 1)->states('admin')->create();
        factory(Role::class, 4)->states('inactive')->create();
    }
}
