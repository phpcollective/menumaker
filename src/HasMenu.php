<?php

namespace PhpCollective\MenuMaker;

use Cache;
use Illuminate\Database\Eloquent\Builder;
use Route;
use Kalnoy\Nestedset\Collection;
use PhpCollective\MenuMaker\Storage\Role;
use PhpCollective\MenuMaker\Storage\Menu;
use PhpCollective\MenuMaker\Storage\Permission;

trait MenuMaker
{
    protected $section;

    /**
     * The group that associates with the group.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'pcmm_role_user');
    }

    public function menus($alease)
    {
        $this->section = Menu::whereAlease($alease)->first();

        if (! $this->section) {
            return collect([]);
        }
        return $this->getMenuItemsWithActive();

    }

    protected function getMenuItemsWithActive()
    {
        $currentRoute = Route::currentRouteName();
        $currentPath = request()->path();
        $menus = $this->getMenuItems();

        $traverse = function ($menus) use (&$traverse, $currentRoute, $currentPath) {
            $checked = collect([]);
            foreach ($menus as $key => $menu) {
                $menu['children'] = $traverse($menu['children'], $currentRoute, $currentPath);
                if((is_array($menu['routes']) && in_array($currentRoute, $menu['routes']))
                    || $currentPath === $menu['link']
                    || $menu['children']->where('active', true)->count())
                {
                    $menu['active'] = true;
                }
                $checked->put($key, new MenuItem($menu));
            }

            return $checked;
        };

        return $traverse($menus);
    }

    protected function getMenuItems()
    {
        return Cache::rememberForever('menus.section.' . optional($this->section)->id . '.user.' . $this->id, function () {
            return $this->admin()
                ? $this->getAdminMenuItems()
                : $this->getUserMenuItems();
        });
    }

    private function getAdminMenuItems()
    {
        $this->section->load([
            'descendants' => function ($query) {
                $query->visible();
            }
        ]);

        return self::buildTree($this->section->descendants, $this->section->id);
    }

    private function getUserMenuItems()
    {
        $this->section->load([
            'descendants' => function ($query) {
                $query->with([
                    'ancestors' => function ($query) {
                        $query->descendantsOf($this->section);
                    }
                ])->select('pcmm_menus.*')
                    ->leftJoin('pcmm_menu_role', 'pcmm_menus.id', '=', 'pcmm_menu_role.menu_id')
                    ->leftJoin('pcmm_roles', 'pcmm_menu_role.role_id', '=', 'pcmm_roles.id')
                    ->leftJoin('pcmm_role_user', 'pcmm_roles.id', '=', 'pcmm_role_user.role_id')
                    ->leftJoin($this->getTable(), 'pcmm_role_user.user_id', '=', $this->getTable() . '.id')
                    ->visible()
                    ->where(function ($query) {
                        $query->wherePrivilege('PUBLIC')
                            ->orWhere(function ($query) {
                                $query->where('pcmm_menus.privilege', 'PROTECTED')
                                    ->where('pcmm_roles.is_active', true)
                                    ->where($this->getTable() . '.id', $this->id);
                            });
                    });
            }
        ]);

        $items = $this->section->descendants->reject(function ($item) {
            return $item->ancestors->contains('privilege', 'PRIVATE')
                || $item->ancestors->contains('visible', false);
        });

        $menus = collect([]);
        foreach ($items as $last) {
            $item = self::buildPartialTree($last->ancestors, $last);
            if ($menus->has($item['id'])) {
                $menus = self::mergeTree($menus, $item);
            } else {
                $menus->put($item['id'], $item);
            }
        }

        return $menus;
    }

    protected static function mergeTree($menus, $item)
    {
        if (isset($menus[$item['id']])) {
            $childItem = $item['children']->first();
            if ($menus[$item['id']]['children']->has($childItem['id'])) {
                $children = $menus[$item['id']]['children'];
                $menus[$item['id']]['children'] = self::mergeTree($children, $childItem);
            } else {
                $menus[$item['id']]['children']->put($childItem['id'], $childItem);
            }
        }
        return $menus;
    }

    protected static function buildPartialTree(Collection $nodes, $lastChild)
    {
        if ($nodes->count()) {
            $node = $nodes->shift();
            $element = self::prepareMenuItem($node);
            $child = $nodes->count()
                ? self::buildPartialTree($nodes, $lastChild)
                : self::prepareMenuItem($lastChild);

            $element['children']->put(
                $child['id'], $child
            );
        } else {
            $element = self::prepareMenuItem($lastChild);
        }
        return $element;
    }

    protected static function buildTree(Collection $nodes, $parent_id = 0)
    {
        $branch = collect([]);

        foreach ($nodes as $node) {
            if ($node->parent_id == $parent_id) {

                $element = self::prepareMenuItem($node);

                $children = self::buildTree($node->children, $node->id);
                if ($children) {
                    $element['children'] = $children;
                }

                $branch->put($element['id'], $element);
            }
        }

        return $branch;
    }

    protected static function prepareMenuItem(Menu $node)
    {
        return [
            'id'       => $node->id,
            'name'     => $node->name,
            'alease'   => $node->alease,
            'routes'   => $node->routes,
            'link'     => $node->link,
            'icon'     => $node->icon,
            'class'    => $node->class,
            'attr'     => $node->attr,
            'active'   => false,
            'children' => collect([])
        ];
    }

    public function admin()
    {
        return $this->roles()->admin()->exists();
    }

    public function approve($alease)
    {
        return $this->admin() || $this->whereHas('roles.menus', function ($query) use ($alease) {
                $query->whereAlease($alease);
            })->exists();
    }

    public function authorize($request)
    {
        $route = explode_route($request->route());
        return $this->whereHas('roles.menus.permissions', function ($query) use ($route) {
            $query->where('namespace', $route['namespace'])
                ->where('controller', $route['controller'])
                ->where('method', $route['method'])
                ->where('action', $route['action']);
        })->exists();
    }
}