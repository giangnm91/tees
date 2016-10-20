<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Helpers\JavOrder;

class JavOrderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    protected $defer = true;

    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Http\Helpers\Contracts\JavOrderContract', function($app){
            return new JavOrder();
        });
    }

    public function provides()
    {
        return ['App\Http\Helpers\Contracts\JavOrderContract'];
    }
}
