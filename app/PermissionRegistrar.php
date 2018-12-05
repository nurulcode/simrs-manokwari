<?php

namespace App;

use PDOException;
use App\Models\Role;
use App\Models\User;
use Sty\ResourceModel;
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

            if (isset($args[0]) && !is_null($policy = Gate::getPolicyFor($args[0]))) {
                return;
            }

            $permission = Permission::where('name', $ability)->first();

            if ($permission) {
                return $user->hasPermission($permission);
            }
        });

        $operations = [
            'index'  => 'view_%s_index||view_%s_page',
            'view'   => 'view_%s_page',
            'show'   => 'view_%s',
            'create' => 'create_%s',
            'update' => 'update_%s',
            'delete' => 'delete_%s',
        ];

        foreach ($operations as $key => $permission) {
            $permissions = explode('||', $permission);

            Gate::define($key, function ($user, $resource) use ($permissions) {
                if (is_string($resource) && class_exists($resource)) {
                    $resource = new $resource;
                }

                if (!$resource instanceof ResourceModel) {
                    return;
                }
                $permkey = $resource->permissionKeyName();

                $result  = $user->can('manage_' . $permkey);

                foreach ($permissions as $permission) {
                    $result = $result || $user->can(sprintf($permission, $permkey));
                }

                return $result;
            });
        }
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
