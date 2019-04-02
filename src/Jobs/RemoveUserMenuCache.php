<?php

namespace PhpCollective\MenuMaker\Jobs;

use Cache;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use PhpCollective\MenuMaker\Storage\Menu;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveUserMenuCache implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @param  MenuUser  $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Menu::sections()->get()->each(function ($section) {
            Cache::forget('menus.section.' . $section->id . '.user.' . $this->user->id);
        });
    }
}
