<?php

use Illuminate\Database\Seeder;
use PhpCollective\MenuMaker\Storage\Menu;

class PcmmPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->data()->each(
            function ($permissions, $key) {
                $menu = Menu::firstWhere('alias', $key);
                if ($menu) {
                    $permissions->each(
                        function ($permission) use ($menu) {
                            $menu->permissions()->firstOrCreate($permission);
                        }
                    );
                } else {
                    echo 'No Menu Is Found with alias="' . $key . '"';
                }
            }
        );
    }

    /**
     * Supply data for seeding
     *
     * @return Collection
     */
    private function data()
    {
        return collect(
            [
                'pcmm-user-list' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'UserController',
                            'method' => 'GET',
                            'action' => 'index'
                        ]
                    ]
                ),
                'pcmm-user-group-assign' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'UserController',
                            'method' => 'GET',
                            'action' => 'edit'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'UserController',
                            'method' => 'PATCH',
                            'action' => 'update'
                        ]
                    ]
                ),
                'pcmm-role-list' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'RoleController',
                            'method' => 'GET',
                            'action' => 'index'
                        ]
                    ]
                ),
                'pcmm-role-create' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'RoleController',
                            'method' => 'GET',
                            'action' => 'create'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'RoleController',
                            'method' => 'POST',
                            'action' => 'store'
                        ]
                    ]
                ),
                'pcmm-role-show' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'RoleController',
                            'method' => 'GET',
                            'action' => 'show'
                        ]
                    ]
                ),
                'pcmm-role-edit' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'RoleController',
                            'method' => 'GET',
                            'action' => 'edit'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'RoleController',
                            'method' => 'PATCH',
                            'action' => 'update'
                        ]
                    ]
                ),
                'pcmm-role-delete' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'RoleController',
                            'method' => 'DELETE',
                            'action' => 'destroy'
                        ]
                    ]
                ),
                'pcmm-role-menu' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'RoleController',
                            'method' => 'GET',
                            'action' => 'menus'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'RoleController',
                            'method' => 'PUT',
                            'action' => 'assign'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'MenuController',
                            'method' => 'GET',
                            'action' => 'tree'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'MenuController',
                            'method' => 'GET',
                            'action' => 'selected'
                        ]
                    ]
                ),
                'pcmm-section-list' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'SectionController',
                            'method' => 'GET',
                            'action' => 'index'
                        ]
                    ]
                ),
                'pcmm-section-create' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'SectionController',
                            'method' => 'GET',
                            'action' => 'create'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'SectionController',
                            'method' => 'POST',
                            'action' => 'store'
                        ]
                    ]
                ),
                'pcmm-section-show' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'SectionController',
                            'method' => 'GET',
                            'action' => 'show'
                        ]
                    ]
                ),
                'pcmm-section-edit' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'SectionController',
                            'method' => 'GET',
                            'action' => 'edit'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'SectionController',
                            'method' => 'PATCH',
                            'action' => 'update'
                        ]
                    ]
                ),
                'pcmm-section-delete' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'SectionController',
                            'method' => 'DELETE',
                            'action' => 'destroy'
                        ]
                    ]
                ),
                'pcmm-menu-list' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'MenuController',
                            'method' => 'GET',
                            'action' => 'index'
                        ]
                    ]
                ),
                'pcmm-menu-create' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'MenuController',
                            'method' => 'GET',
                            'action' => 'create'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'MenuController',
                            'method' => 'GET',
                            'action' => 'filter'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'MenuController',
                            'method' => 'POST',
                            'action' => 'store'
                        ]
                    ]
                ),
                'pcmm-menu-show' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'MenuController',
                            'method' => 'GET',
                            'action' => 'show'
                        ]
                    ]
                ),
                'pcmm-menu-edit' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'MenuController',
                            'method' => 'GET',
                            'action' => 'edit'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'MenuController',
                            'method' => 'GET',
                            'action' => 'filter'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'MenuController',
                            'method' => 'PATCH',
                            'action' => 'update'
                        ]
                    ]
                ),
                'pcmm-menu-delete' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'MenuController',
                            'method' => 'DELETE',
                            'action' => 'destroy'
                        ]
                    ]
                ),
                'pcmm-permissions' => collect(
                    [
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'PermissionController',
                            'method' => 'GET',
                            'action' => 'index'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'PermissionController',
                            'method' => 'GET',
                            'action' => 'selected'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'MenuController',
                            'method' => 'GET',
                            'action' => 'filter'
                        ],
                        [
                            'namespace' => 'PhpCollective\MenuMaker\Http\Controllers',
                            'controller' => 'PermissionController',
                            'method' => 'PUT',
                            'action' => 'update'
                        ]
                    ]
                ),
            ]
        );
    }
}
