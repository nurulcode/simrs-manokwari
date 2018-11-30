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

        Gate::before(function ($user, $ability, $args) use ($do_anything) {
            if (array_first($args, function ($arg) {
                return $arg instanceof User || $arg instanceof Role;
            })) {
                return;
            }

            if ($user->isSuperAdmin() || $user->hasRole($do_anything->roles)) {
                return true;
            }

            if (Gate::has($ability)) {
                return;
            }

            $permission = Permission::where('name', $ability)->first();

            return $user->hasPermission($permission);
        });
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
