<?php

namespace App\Providers;

use Sty\CrudResponse;
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
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
