<?php

namespace PhpCollective\MenuMaker\Storage;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use PhpCollective\MenuMaker\Scopes\ActiveRoleScope;

class Role extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pcmm_roles';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'is_active',
        'is_admin'
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 10;

    /**
     * The group's default attributes.
     *
     * @var array
     */
    protected $attributes = [
        'is_active' => true,
        'is_admin' => false
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'integer',
        'is_admin' => 'integer'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($group) {
            if($group->is_admin)
            {
                static::where('is_admin', true)
                    ->where('id', '!=', $group->id)
                    ->update(['is_admin' => false]);
            }
        });

        static::addGlobalScope(new ActiveRoleScope);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param boolean $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdmin(Builder $query, $status = true)
    {
        return $query->where('is_admin', $status);
    }

    /**
     * The users that associates with the group.
     */
    public function users()
    {
        return $this->belongsToMany(config('auth.providers.users.model'), 'pcmm_role_user', 'role_id', 'user_id');
    }

    /**
     * Get the menus that related with the group.
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'pcmm_menu_role');
    }
}
