<?php

namespace App\Models;

use Sty\HasPath;
use Sty\HasPolicy;
use Sty\FilterScope;
use Sty\ResourceModel;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements ResourceModel
{
    use FilterScope,
        HasApiTokens,
        HasPath,
        HasPolicy,
        Notifiable;

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

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['roles'];

    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
