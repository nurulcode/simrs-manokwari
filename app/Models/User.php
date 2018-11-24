<?php

namespace App\Models;

use Sty\HasPath;
use Sty\ResourceModel;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements ResourceModel
{
    use Notifiable, HasApiTokens, HasPath;

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

    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }
}
