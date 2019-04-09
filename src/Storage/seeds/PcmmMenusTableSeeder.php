<?php

use Illuminate\Database\Seeder;
use PhpCollective\MenuMaker\Storage\Menu;

class PcmmMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->data()->each(function ($data) {
            Menu::create($data);
        });
    }

    /**
     * Supply data for seeding
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function data()
    {
        return collect([
            [
                'name'     => 'Menu Maker',
                'alease'   => 'menu-maker',
                'children' => [
                    [
                        'name'      => 'Home',
                        'alease'    => 'home',
                        'routes'    => '',
                        'link'      => config('menu.path'),
                        'icon'      => '',
                        'class'     => '',
                        'privilege' => 'PUBLIC',
                    ],
                    [
                        'name'     => 'Users',
                        'alease'   => 'pcmm-users',
                        'routes'   => 'menu-maker::users.index,menu-maker::users.edit',
                        'link'     => config('menu.path') . '/users',
                        'icon'     => '',
                        'class'    => '',
                        'children' => [
                            [
                                'name'    => 'List',
                                'alease'  => 'pcmm-user-list',
                                'routes'  => 'menu-maker::users.index',
                                'link'    => config('menu.path') . '/users',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Assign Group',
                                'alease'  => 'pcmm-user-group-assign',
                                'routes'  => 'menu-maker::users.edit',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ]
                        ],
                    ],
                    [
                        'name'     => 'Roles',
                        'alease'   => 'pcmm-roles',
                        'routes'   => 'menu-maker::roles.index,menu-maker::roles.create,menu-maker::roles.edit,menu-maker::roles.show',
                        'link'     => config('menu.path') . '/roles',
                        'icon'     => '',
                        'class'    => '',
                        'children' => [
                            [
                                'name'    => 'List',
                                'alease'  => 'pcmm-role-list',
                                'routes'  => 'menu-maker::roles.index',
                                'link'    => config('menu.path') . '/roles',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Create',
                                'alease'  => 'pcmm-role-create',
                                'routes'  => 'menu-maker::roles.create',
                                'link'    => config('menu.path') . '/role/create',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'View',
                                'alease'  => 'pcmm-role-show',
                                'routes'  => 'menu-maker::roles.show',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Edit',
                                'alease'  => 'pcmm-role-edit',
                                'routes'  => 'menu-maker::roles.edit',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Delete',
                                'alease'  => 'pcmm-role-delete',
                                'routes'  => 'menu-maker::roles.delete',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ]
                        ],
                    ],
                    [
                        'name'     => 'Sections',
                        'alease'   => 'pcmm-sections',
                        'routes'   => 'menu-maker::sections.index,menu-maker::sections.create,menu-maker::sections.edit,menu-maker::sections.show',
                        'link'     => config('menu.path') . '/sections',
                        'icon'     => '',
                        'class'    => '',
                        'children' => [
                            [
                                'name'    => 'List',
                                'alease'  => 'pcmm-section-list',
                                'routes'  => 'menu-maker::sections.index',
                                'link'    => config('menu.path') . '/sections',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Create',
                                'alease'  => 'pcmm-section-create',
                                'routes'  => 'menu-maker::sections.create',
                                'link'    => config('menu.path') . '/section/create',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'View',
                                'alease'  => 'pcmm-section-show',
                                'routes'  => 'menu-maker::sections.show',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Edit',
                                'alease'  => 'pcmm-section-edit',
                                'routes'  => 'menu-maker::sections.edit',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Delete',
                                'alease'  => 'pcmm-section-delete',
                                'routes'  => 'menu-maker::sections.delete',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ]
                        ],
                    ],
                    [
                        'name'     => 'Menus',
                        'alease'   => 'pcmm-menus',
                        'routes'   => 'menu-maker::menus.index,menu-maker::menus.create,menu-maker::menus.edit,menu-maker::menus.show',
                        'link'     => config('menu.path') . '/menus',
                        'icon'     => '',
                        'class'    => '',
                        'children' => [
                            [
                                'name'    => 'List',
                                'alease'  => 'pcmm-menu-list',
                                'routes'  => 'menu-maker::menus.index',
                                'link'    => config('menu.path') . '/menus',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Create',
                                'alease'  => 'pcmm-menu-create',
                                'routes'  => 'menu-maker::menus.create',
                                'link'    => config('menu.path') . '/menu/create',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'View',
                                'alease'  => 'pcmm-menu-show',
                                'routes'  => 'menu-maker::menus.show',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Edit',
                                'alease'  => 'pcmm-menu-edit',
                                'routes'  => 'menu-maker::menus.edit',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Delete',
                                'alease'  => 'pcmm-menu-delete',
                                'routes'  => 'menu-maker::menus.delete',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ]
                        ],
                    ],
                    [
                        'name'      => 'Permissions',
                        'alease'    => 'pcmm-permissions',
                        'routes'    => 'menu-maker::permissions.index',
                        'link'      => config('menu.path') . '/permissions',
                        'icon'      => '',
                        'class'     => '',
                        'privilege' => 'PRIVATE',
                        'children'  => [
                            [
                                'name'    => 'Set Menu Routes',
                                'alease'  => 'pcmm-permission-list',
                                'routes'  => 'menu-maker::permissions.index',
                                'link'    => config('menu.path') . '/permissions',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ]
                        ],
                    ]
                ]
            ]
        ]);
    }
}
