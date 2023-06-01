<?php

namespace Sayedsoft\StakeToken;

use Illuminate\Support\ServiceProvider;
use Sayedsoft\StakeToken\Models\Career\UserCareerProfits;
use Sayedsoft\StakeToken\Models\Stake;
use Sayedsoft\StakeToken\Models\StakeDetails;
use Sayedsoft\StakeToken\Observes\CareerProfitObserve;
use Sayedsoft\StakeToken\Observes\StakeDetailsObserve;
use Sayedsoft\StakeToken\Observes\StakeObserve;

class StakeTokenServiceProvider extends ServiceProvider
{   

    /**
     * Bootstrap the application services.
    */
    public function boot()
    {
       
        Stake::observe(StakeObserve::class);

        StakeDetails::observe(StakeDetailsObserve::class);

        UserCareerProfits::observe(CareerProfitObserve::class);
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'stake-token');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'stake-token');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');
        
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('stake-token.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/stake-token'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/stake-token'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/stake-token'),
            ], 'lang');*/

            // Registering package commands.
             $this->commands([
                'Sayedsoft\StakeToken\Commands\CheckStakeCommand',
             ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'stake-token');

        // Register the main class to use with the facade
        $this->app->singleton('stake-token', function () {
            return new StakeToken;
        });
    }
}
