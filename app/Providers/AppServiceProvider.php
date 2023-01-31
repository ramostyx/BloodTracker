<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('Role', function ($role)
        {
            return Auth::user() && Auth::user()->hasRole($role);
        });

        Blade::if('Owner', function ($id)
        {
            return Auth::user() &&  Auth::user()->owner($id);
        });
    }
}
