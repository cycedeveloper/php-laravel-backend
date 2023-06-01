<?php

namespace Sayedsoft\DexAuthReferral;

use Illuminate\Auth\Events\Verified;
use Illuminate\Support\ServiceProvider;
use Sayedsoft\DexAuthReferral\Listeners\LogVerifiedUser;

class DexAuthReferralServiceProvider extends ServiceProvider
{   


    protected $listen = [ 
     
    ];
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /* 
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'dex-auth-referral');
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'dexauth');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
         $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('dex-auth-referral.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/dexauth'),
            ], 'views');

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/dex-auth-referral'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/dex-auth-referral'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'dex-auth-referral');

        // Register the main class to use with the facade
        $this->app->singleton('dex-auth-referral', function () {
            return new DexAuthReferral;
        });
    }
}
