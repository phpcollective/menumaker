<?php

namespace PhpCollective\MenuMaker;

use Blade;
use Route;
use Illuminate\Support\ServiceProvider;
use PhpCollective\MenuMaker\Storage\Menu;
use PhpCollective\MenuMaker\Storage\Role;
use Illuminate\Auth\SessionGuard as AuthGuard;
use PhpCollective\MenuMaker\Observers\MenuObserver;
use PhpCollective\MenuMaker\Observers\RoleObserver;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Role::observe(RoleObserver::class);
        Menu::observe(MenuObserver::class);

        AuthGuard::macro('menus', function ($section) {
            return $this->user()->menus($section);
        });

        Blade::if('approve', function ($menu) {
            return auth()->user()->approve($menu);
        });

        Route::model('user', '\\' . ltrim(config('auth.providers.users.model'), '\\'));

        $this->registerRoutes();
        $this->registerMigrations();
        $this->registerPublishing();

        $this->loadViewsFrom(
            __DIR__ . '/../resources/views', 'menu-maker'
        );

        $this->loadTranslationsFrom(
            __DIR__ . '/../resources/lang', 'menu-maker'
        );
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        });
    }

    /**
     * Get the Menu Maker route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'namespace'  => 'PhpCollective\MenuMaker\Http\Controllers',
            'prefix'     => config('menu.path'),
            'middleware' => ['web', 'auth'],
        ];
    }

    /**
     * Register the package's migrations.
     *
     * @return void
     */
    private function registerMigrations()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/Storage/migrations');
        }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    private function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/Storage/migrations' => database_path('migrations'),
            ], 'menu-migrations');

            $this->publishes([
                __DIR__ . '/../public' => public_path('vendor/menu-maker'),
            ], 'menu-assets');

            $this->publishes([
                __DIR__ . '/../config/menu.php' => config_path('menu.php'),
            ], 'menu-config');

            $this->publishes([
                __DIR__.'/../stubs/VerifyMenuAuthorization.stub' => app_path('Http/Middleware/VerifyMenuAuthorization.php'),
            ], 'menu-middleware');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('userModel', function () {
            $class = '\\' . ltrim(config('auth.providers.users.model'), '\\');

            return new $class;
        });

        $this->mergeConfigFrom(
            __DIR__ . '/../config/menu.php', 'menu'
        );
    }
}