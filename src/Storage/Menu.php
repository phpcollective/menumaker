<?php

namespace PhpCollective\MenuMaker\Storage;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
    use NodeTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pcmm_menus';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'name',
        'alease',
        'routes',
        'link',
        'icon',
        'class',
        'attr',
        'position',
        'privilege',
        'visible',
    ];

    /**
     * The group's default attributes.
     *
     * @var array
     */
    protected $attributes = [
        'parent_id' => null,
        'routes'    => null,
        'link'      => null,
        'icon'      => null,
        'class'     => null,
        'attr'      => null,
        'position'  => 0,
        'privilege' => self::DEFAULT_PRIVILAGE,
        'visible'   => true,
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'visible' => 'integer',
        'routes'  => 'array',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        '_lft',
        '_rgt',
        'position'
    ];

    const DEFAULT_PRIVILAGE = 'PROTECTED';

    public static $privileges = [
        'PUBLIC'    => 'Public',
        'PROTECTED' => 'Protected',
        'PRIVATE'   => 'Private',
    ];

    /*
    |--------------------------------------------------------------------------
    | Booting
    |--------------------------------------------------------------------------
    */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($menu) {
            $menu->position = self::position($menu->parent_id);
        });
    }

    protected static function position($parent_id)
    {
        return self::where('parent_id', $parent_id)
                ->max('position') + 1;
    }

    public static function rearrangePosition($commonStrategicObjectiveId)
    {
        (new static)->ofCommonStrategicObjective($commonStrategicObjectiveId)
            ->get()
            ->each(function ($objective, $key) {
                $objective->sequence = $key + 1;
                $objective->save();
            });
    }

    /**
     * Filter query result based on user search.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeFilter(Builder $query)
    {
        $query->where('id', '<>', request('e_id'));
        if (request()->has('p_id')) {
            $query->where('parent_id', request('p_id'));
        }

        return $query;
    }

    public function setRoutesAttribute($value)
    {
        $this->attributes['routes'] = $value
            ? json_encode(array_map('trim', explode(',', $value)))
            : null;
    }

    public function getRouteListAttribute()
    {
        if (! $this->routes) {
            return $this->routes;
        }
        return implode(', ', $this->routes);
    }

    public function setLinkAttribute($value)
    {
        $link = str_replace(url('/'), '', $value);
        $this->attributes['link'] = trim($link, '/');
    }

    public function scopeSections(Builder $query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeVisible(Builder $query)
    {
        return $query->whereVisible(true);
    }

    /**
     * The permissions that associates with this menu.
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    /**
     * Get the roles that related with the menu.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'pcmm_menu_role');
    }

    public static function findParent()
    {
        $parent_ids = request('parent_id', []);
        $parent_id = null;
        do {
            $parent_id = array_pop($parent_ids);
        } while (is_null($parent_id) && count($parent_ids) > 0);

        return $parent_id;
    }
}
