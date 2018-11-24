<?php

namespace App\Models;

trait HasRoles
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getRoleAttribute()
    {
        return $this->roles->isNotEmpty() ? $this->roles->first() : Role::none();
    }

    public function giveRoleAs($role)
    {
        if (!$role instanceof Role) {
            $role = Role::where('name', $role)->firstOrFail();
        }

        $this->roles()->attach($role->id);
    }

    public function hasRole($role)
    {
        if ($role instanceof Role) {
            $role = $role->name;
        }

        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return $role->intersect($this->roles)->isNotEmpty();
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('superadmin');
    }
}
