<?php

namespace PhpCollective\MenuMaker\Observers;

use PhpCollective\MenuMaker\Storage\Role;
use PhpCollective\MenuMaker\Jobs\RemoveUserMenuCache;

class RoleObserver
{
    /**
     * Handle the Role "updated" event.
     *
     * @param  \App\Role  $group
     * @return void
     */
    public function updated(Role $group)
    {
        $this->removeCache($group);
    }

    /**
     * Handle the Role "deleting" event.
     *
     * @param  \App\Role  $group
     * @return void
     */
    public function deleting(Role $group)
    {
        $this->removeCache($group);
    }

    /**
     * Handle the Cache delete.
     *
     * @param  \App\Role  $group
     * @return void
     */
    private function removeCache(Role $group)
    {
        $group->users->each(function ($user) {
            RemoveUserMenuCache::dispatch($user);
        });
    }
}