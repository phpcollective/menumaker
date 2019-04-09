<?php

namespace PhpCollective\MenuMaker\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use PhpCollective\MenuMaker\Jobs\RemoveUserMenuCache;

class ClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all cache from Menu Maker';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Cache::forget('routes');
        Cache::forget('excluded-action-list');
        Cache::forget('route-actions');
        $model = resolve('userModel');
        $model->chunk(100, function ($users) {
            $users->each(function ($user) {
                RemoveUserMenuCache::dispatch($user);
            });
        });

        $this->info('Menu caches cleared!');
    }
}
