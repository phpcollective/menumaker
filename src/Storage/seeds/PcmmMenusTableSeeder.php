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
                'alias'   => 'menu-maker',
                'children' => [
                    [
                        'name'      => 'Home',
                        'alias'    => 'home',
                        'routes'    => '',
                        'link'      => config('menu.path'),
                        'icon'      => '',
                        'class'     => '',
                        'privilege' => 'PUBLIC',
                    ],
                    [
                        'name'     => 'Users',
                        'alias'   => 'pcmm-users',
                        'routes'   => 'menu-maker::users.index,menu-maker::users.edit',
                        'link'     => config('menu.path') . '/users',
                        'icon'     => '',
                        'class'    => '',
                        'children' => [
                            [
                                'name'    => 'List',
                                'alias'  => 'pcmm-user-list',
                                'routes'  => 'menu-maker::users.index',
                                'link'    => config('menu.path') . '/users',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Assign Group',
                                'alias'  => 'pcmm-user-group-assign',
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
                        'alias'   => 'pcmm-roles',
                        'routes'   => 'menu-maker::roles.index,menu-maker::roles.create,menu-maker::roles.edit,menu-maker::roles.show',
                        'link'     => config('menu.path') . '/roles',
                        'icon'     => '',
                        'class'    => '',
                        'children' => [
                            [
                                'name'    => 'List',
                                'alias'  => 'pcmm-role-list',
                                'routes'  => 'menu-maker::roles.index',
                                'link'    => config('menu.path') . '/roles',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Create',
                                'alias'  => 'pcmm-role-create',
                                'routes'  => 'menu-maker::roles.create',
                                'link'    => config('menu.path') . '/role/create',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'View',
                                'alias'  => 'pcmm-role-show',
                                'routes'  => 'menu-maker::roles.show',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Edit',
                                'alias'  => 'pcmm-role-edit',
                                'routes'  => 'menu-maker::roles.edit',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Delete',
                                'alias'  => 'pcmm-role-delete',
                                'routes'  => 'menu-maker::roles.delete',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name' => 'Set Permission',
                                'alias' => 'pcmm-role-menu',
                                'routes' => 'menu-maker::roles.menus',
                                'link' => config('menu.path') . '/roles/menus',
                                'icon' => '',
                                'class' => '',
                                'privilege' => 'PROTECTED',
                                'visible' => false
                            ]
                        ],
                    ],
                    [
                        'name'     => 'Sections',
                        'alias'   => 'pcmm-sections',
                        'routes'   => 'menu-maker::sections.index,menu-maker::sections.create,menu-maker::sections.edit,menu-maker::sections.show',
                        'link'     => config('menu.path') . '/sections',
                        'icon'     => '',
                        'class'    => '',
                        'children' => [
                            [
                                'name'    => 'List',
                                'alias'  => 'pcmm-section-list',
                                'routes'  => 'menu-maker::sections.index',
                                'link'    => config('menu.path') . '/sections',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Create',
                                'alias'  => 'pcmm-section-create',
                                'routes'  => 'menu-maker::sections.create',
                                'link'    => config('menu.path') . '/section/create',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'View',
                                'alias'  => 'pcmm-section-show',
                                'routes'  => 'menu-maker::sections.show',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Edit',
                                'alias'  => 'pcmm-section-edit',
                                'routes'  => 'menu-maker::sections.edit',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Delete',
                                'alias'  => 'pcmm-section-delete',
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
                        'alias'   => 'pcmm-menus',
                        'routes'   => 'menu-maker::menus.index,menu-maker::menus.create,menu-maker::menus.edit,menu-maker::menus.show',
                        'link'     => config('menu.path') . '/menus',
                        'icon'     => '',
                        'class'    => '',
                        'children' => [
                            [
                                'name'    => 'List',
                                'alias'  => 'pcmm-menu-list',
                                'routes'  => 'menu-maker::menus.index',
                                'link'    => config('menu.path') . '/menus',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Create',
                                'alias'  => 'pcmm-menu-create',
                                'routes'  => 'menu-maker::menus.create',
                                'link'    => config('menu.path') . '/menu/create',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'View',
                                'alias'  => 'pcmm-menu-show',
                                'routes'  => 'menu-maker::menus.show',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Edit',
                                'alias'  => 'pcmm-menu-edit',
                                'routes'  => 'menu-maker::menus.edit',
                                'link'    => '',
                                'icon'    => '',
                                'class'   => '',
                                'visible' => false
                            ],
                            [
                                'name'    => 'Delete',
                                'alias'  => 'pcmm-menu-delete',
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
                        'alias'    => 'pcmm-permissions',
                        'routes'    => 'menu-maker::permissions.index',
                        'link'      => config('menu.path') . '/permissions',
                        'icon'      => '',
                        'class'     => '',
                        'privilege' => 'PRIVATE',
                        'children'  => [
                            [
                                'name'    => 'Set Menu Routes',
                                'alias'  => 'pcmm-permission-list',
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
