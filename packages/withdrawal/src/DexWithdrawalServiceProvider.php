<?php

namespace Sayedsoft\DexWithdrawal;

use Illuminate\Support\ServiceProvider;
use Sayedsoft\Dex\Base\Traits\FlashMessages;
use Sayedsoft\DexWithdrawal\Models\Withdrawal;
use Sayedsoft\DexWithdrawal\Observers\WithdrawalRequestObserve;

class DexWithdrawalServiceProvider extends ServiceProvider
{

    public function boot()
    {   

       

        Withdrawal::observe(WithdrawalRequestObserve::class);


        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'dex-withdrawal');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'dex-withdrawal');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('dex-withdrawal.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/dex-withdrawal'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/dex-withdrawal'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/dex-withdrawal'),
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
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'dex-withdrawal');

        // Register the main class to use with the facade
        $this->app->singleton('dex-withdrawal', function () {
            return new DexWithdrawal;
        });


    }
}
