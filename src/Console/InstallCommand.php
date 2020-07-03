<?php

namespace PhpCollective\MenuMaker\Console;

use Illuminate\Support\Str;
use Illuminate\Console\Command;

class InstallCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the Menu Maker resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Publishing Menu Assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'menu-assets']);

        $this->comment('Publishing Menu Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'menu-config']);

        $this->comment('Menu Database Files Migrating...');
        $this->call('migrate', [
            '--force'   => true
        ]);

        $this->registerMenuAuthorizationMiddleware();

        $this->info('Menu scaffolding installed successfully.');
    }

    /**
     * Register the Menu authorization middleware in the application Kernel file.
     *
     * @return void
     */
    protected function registerMenuAuthorizationMiddleware()
    {
        $kernelFile = file_get_contents(app_path('Http/Kernel.php'));
        if (Str::contains($kernelFile, '\\PhpCollective\\MenuMaker\\Http\\Middleware\\VerifyMenuAuthorization::class')) {
            return;
        }

        file_put_contents(app_path('Http/Kernel.php'), str_replace(
            "\\Illuminate\Auth\Middleware\Authorize::class,".PHP_EOL,
            "\\Illuminate\Auth\Middleware\Authorize::class,".PHP_EOL."        'menu' => \\PhpCollective\MenuMaker\Http\Middleware\VerifyMenuAuthorization::class,".PHP_EOL,
            $kernelFile
        ));
    }
}
