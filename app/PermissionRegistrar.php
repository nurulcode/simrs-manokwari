<?php

namespace App;

use PDOException;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;

class PermissionRegistrar
{
    public function registerPermissions()
    {
        $do_anything = $this->doAnythingPermission();

        foreach ($this->permissions() as $permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                return $user->hasRole($permission->roles);
            });
        }

        Gate::before(function ($user, $ability, $args) use ($do_anything) {
            if (array_first($args, function ($arg) {
                return $arg instanceof User || $arg instanceof Role;
            })) {
                return;
            }

            if ($user->isSuperAdmin() || $user->hasRole($do_anything->roles)) {
                return true;
            }
        });
    }

    protected function permissions()
    {
        try {
            return Permission::with('roles')->get();
        } catch (PDOException $e) {
            //
        }

        return [];
    }

    public function doAnythingPermission()
    {
        try {
            return Permission::with('roles')->where('name', 'do_anything')->first();
        } catch (PDOException $e) {
            //
        }

        return new Permission;
    }
}
