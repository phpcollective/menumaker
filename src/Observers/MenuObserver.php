<?php

namespace PhpCollective\MenuMaker\Observers;


use Illuminate\Support\Facades\Cache;
use PhpCollective\MenuMaker\Storage\Menu;
use PhpCollective\MenuMaker\Storage\Role;
use PhpCollective\MenuMaker\Jobs\RemoveUserMenuCache;

class MenuObserver
{

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Menu  $menu
     * @return void
     */
    public function created(Menu $menu)
    {
        $this->removeAdminCache();
    }

    /**
     * Handle the Menu "updated" event.
     *
     * @param  \App\Menu  $menu
     * @return void
     */
    public function updated(Menu $menu)
    {
        $this->removeAdminCache();
        $this->removeUserCache($menu);
    }

    /**
     * Handle the Menu "deleting" event.
     *
     * @param  Menu  $menu
     * @return void
     */
    public function deleting(Menu $menu)
    {
        $this->removeAdminCache();
        $this->removeUserCache($menu);
    }

    /**
     * Handle User Cache delete.
     *
     * @param  Menu  $menu
     * @return void
     */
    private function removeUserCache(Menu $menu)
    {
        $menu->load('roles', 'roles.users');
        $menu->roles->each(function ($role) {
            $role->users->each(function ($user) {
                RemoveUserMenuCache::dispatch($user);
            });
        });
    }

    /**
     * Handle Admin User Cache delete.
     *
     * @return void
     */
    private function removeAdminCache()
    {
        Cache::forget('public-routes');

        $admin = Role::with('users')->admin()->first();
        if(! $admin)
        {
            return;
        }

        $admin->users->each(function ($user) {
            RemoveUserMenuCache::dispatch($user);
        });
    }
}
