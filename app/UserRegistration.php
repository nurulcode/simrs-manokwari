<?php

namespace App;

use App\Models\User;

class UserRegistration
{
    public static function create($request_data)
    {
        $user = User::create(array_except($request_data, 'roles'));

        return self::assignRoles($user, array_get($request_data, 'roles'));
    }

    protected static function assignRoles(User $user, $roles)
    {
        $user->roles()->sync(
            collect($roles)->map(function ($role) {
                return $role['id'];
            })->values()
        );

        return $user->load('roles');
    }

    public static function update(User $user, $request_data)
    {
        $user->update(array_except($request_data, 'roles'));

        return self::assignRoles($user, array_get($request_data, 'roles'));
    }
}
