<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserActivationToggleController extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $this->authorize('activate', $user);

        if ($user->isSuperAdmin()) {
            return abort(403);
        }

        return crud_response(new UserResource(
            tap($user, function ($user) use ($request) {
                $currentState = $user->active;
                $user->active = $request->input('active', !$currentState);

                $user->save();
            })
        ));
    }
}
