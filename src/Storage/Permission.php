<?php

namespace PhpCollective\MenuMaker\Storage;

use Cache;
use Route;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pcmm_permissions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'namespace',
        'controller',
        'method',
        'action',
        'allowed'
    ];

    /**
     * The group's default attributes.
     *
     * @var array
     */
    protected $attributes = [
        'allowed' => false
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'allowed' => 'integer'
    ];

    /**
     * Get the menu of the permission.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }


    public static function routes()
    {
        return Cache::remember('routes', now()->addHour(), function () {
            $filterRoutes = [];
            $routes = Route::getRoutes();
            foreach ($routes as $route) {
                if (! self::routeMatch($route)) {
                    continue;
                }
                $filterRoutes[] = explode_route($route);
            }
            return collect($filterRoutes);
        });
    }

    public static function excludedActionList()
    {
        return Cache::rememberForever('excluded-action-list', function () {
            $excluded = collect();
            $routes = Route::getRoutes();
            foreach ($routes as $route) {
                if (is_working_route($route) && is_excluded_route($route)) {
                    $excluded->push($route->getActionName());
                }
            }
            return $excluded;
        });
    }

    public static function actions()
    {
        return Cache::rememberForever('route-actions', function () {
            $actions = [];
            self::routes()->each(function ($route) use (&$actions) {
                $actions[$route['namespace']][$route['controller']][$route['method']][] = $route['action'];
            });
            ksort($actions);
            return $actions;
        });
    }

    private static function routeMatch($route)
    {
        return is_working_route($route) && ! is_excluded_route($route);
    }
}
