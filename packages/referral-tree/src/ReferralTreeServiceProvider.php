<?php

namespace Sayedsoft\ReferralTree;

use Illuminate\Support\ServiceProvider;

class ReferralTreeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'referral-tree');
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'referral-tree');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('referral-tree.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/referral-tree'),
            ], 'views');*/

            //Publishing assets.
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/referral-tree'),
            ], 'assets');

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/referral-tree'),
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
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'referral-tree');

        // Register the main class to use with the facade
        $this->app->singleton('referral-tree', function () {
            return new ReferralTree;
        });
    }
}
