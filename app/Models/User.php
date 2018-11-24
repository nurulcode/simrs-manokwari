<?php

namespace App\Models;

use Sty\HasPath;
use Sty\FilterScope;
use Sty\ResourceModel;
use Sty\HasPermissions;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements ResourceModel
{
    use Notifiable, HasApiTokens, HasPath, FilterScope, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['active' => 'boolean'];

    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }
}
