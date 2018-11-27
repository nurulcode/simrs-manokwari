<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model collection.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function index(User $user)
    {
        return $user->can('view_user_index') || $user->can('view_user_page');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->can('view_user_page');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('create_user');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\App\Models\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->can('update_user');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\App\Models\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->can('delete_user');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\App\Models\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        return $user->can('delete_user');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\App\Models\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        return $user->can('delete_user');
    }

    public function activate(User $user, User $model)
    {
        return $user->can('update_user');
    }

    public function view_page(User $user)
    {
        return $user->can('view_user_page');
    }

    public function before(User $user, $ability)
    {
        if ($user->can('manage_user')) {
            return true;
        }
    }
}
