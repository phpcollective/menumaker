<?php

namespace PhpCollective\MenuMaker\Storage;

use Cache;
use Illuminate\Database\Eloquent\Builder;
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

    public static function publicRoutes()
    {
        return Cache::rememberForever('public-routes', function () {
            return collect(self::public()->get()->toArray());
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

    public function scopeOfRoute(Builder $query, $route)
    {
        return $query->where(function ($query) use ($route) {
            $query->where('namespace', $route['namespace'])
                ->where('controller', $route['controller'])
                ->where('method', $route['method'])
                ->where('action', $route['action']);
        });
    }

    public function scopePublic(Builder $query)
    {
        return $query->select('pcmm_permissions.*')
            ->leftJoin('pcmm_menus', 'pcmm_menus.id', '=', 'pcmm_permissions.menu_id')
            ->where('pcmm_menus.privilege', 'PUBLIC')
            ->where('pcmm_permissions.method', 'GET');
    }
}
