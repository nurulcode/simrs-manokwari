<?php

namespace App\Providers;

use App\PermissionRegistrar;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerResourcePolicies();

        $this->registerPolicies();

        $this->registerPassportRoute();

        $this->registerPermissions();
    }

    public function registerPassportRoute()
    {
        Passport::routes();
    }

    public function registerResourcePolicies()
    {
        foreach (config('resources') as $resource) {
            $policy = with(new $resource)->policy();

            if (class_exists($policy)) {
                $this->policies[$resource] = $policy;
            }
        }
    }

    public function registerPermissions()
    {
        with(new PermissionRegistrar())->registerPermissions();
    }
}
