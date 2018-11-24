<?php

namespace App\Models;

class Role extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['permissions'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermsissionTo($permission)
    {
        if (!$permission instanceof Permission) {
            $permission = Permission::where('name', $permission)->firstOrFail();
        }

        $this->permissions()->attach($permission->id);
    }
}
