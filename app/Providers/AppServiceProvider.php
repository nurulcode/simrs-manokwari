<?php

namespace App\Providers;

use Sty\CrudResponse;
use BenSampo\Enum\Enum;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Response::macro('crud', function ($data, $state = null) {
            return with(new CrudResponse($data, $state))->response();
        });

        Enum::macro('toSelectOptions', function () {
            return Collection::wrap(self::toSelectArray())->map(function ($item, $key) {
                return ['value' => $key, 'label' => $item];
            })->values();
        });

        Enum::macro('toSelectValue', function ($value) {
            if (!is_null($value)) {
                return ['value' => $value, 'label' => self::getDescription($value)];
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
