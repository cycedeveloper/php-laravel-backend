<?php

namespace Sayedsoft\DexwithdrawalFiat;

use Illuminate\Support\ServiceProvider;
use Sayedsoft\Dex\Base\Traits\FlashMessages;
use Sayedsoft\DexwithdrawalFiat\Models\withdrawalFiat;
use Sayedsoft\DexwithdrawalFiat\Observers\withdrawalFiatRequestObserve;

class DexwithdrawalFiatServiceProvider extends ServiceProvider
{

    public function boot()
    {   

       

        withdrawalFiat::observe(withdrawalFiatRequestObserve::class);


        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'dex-withdrawalFiat');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dex-withdrawalFiat');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('dex-withdrawalFiat.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/dex-withdrawalFiat'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/dex-withdrawalFiat'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/dex-withdrawalFiat'),
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
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'dex-withdrawalFiat');

        // Register the main class to use with the facade
        $this->app->singleton('dex-withdrawalFiat', function () {
            return new DexwithdrawalFiat;
        });


    }
}
