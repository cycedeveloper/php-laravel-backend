<?php

namespace Sayedsoft\ReferralIncome;

use Illuminate\Support\ServiceProvider;
use Sayedsoft\ReferralIncome\Models\ReferralIncomeModel;
use Sayedsoft\ReferralIncome\Observers\ReferralIncomeObserve;

class ReferralIncomeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {   

        ReferralIncomeModel::observe(ReferralIncomeObserve::class);
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'referral-income');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'referral-income');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('referral-income.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/referral-income'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/referral-income'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/referral-income'),
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
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'referral-income');

        // Register the main class to use with the facade
        $this->app->singleton('referral-income', function () {
            return new ReferralIncome;
        });
    }
}
