<?php

namespace Sayedsoft\Dex;

use Illuminate\Support\ServiceProvider;
use Sayedsoft\Dex\Accounting\Models\AccountingBalance;
use Sayedsoft\Dex\Accounting\Models\AccountingTotal;
use Sayedsoft\Dex\Accounting\Observers\AccountingBalanceObserve;
use Sayedsoft\Dex\Accounting\Observers\AccountingTotalObserve;
use Sayedsoft\Dex\Base\Traits\FlashMessages;
use Sayedsoft\Dex\WalletDeposit\Models\ExtraBalance;
use Sayedsoft\Dex\WalletDeposit\Models\PaymentWalletsDeposit;
use Sayedsoft\Dex\WalletDeposit\Observers\ExtraBalanceObserve;
use Sayedsoft\Dex\WalletDeposit\Observers\WalletDepositObserve;
use Sayedsoft\Dex\Withdrawal\Models\Withdrawal;
use Sayedsoft\Dex\Withdrawal\Observers\WithdrawalRequestObserve;
use Sayedsoft\Dex\Withdrawal\Withdraw;

class DexServiceProvider extends ServiceProvider
{   


    protected $listen = [ 
       
    ];


    /**
     * Bootstrap the application services.
     */
    public function boot() 
    {   
      
        PaymentWalletsDeposit::observe(WalletDepositObserve::class);

        AccountingTotal::observe(AccountingTotalObserve::class);

        AccountingBalance::observe(AccountingBalanceObserve::class);

        ExtraBalance::observe(ExtraBalanceObserve::class);

        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'dex');
         $this->loadViewsFrom(__DIR__.'/../resources/views', 'dex');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('dex.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/dex'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/dex'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/dex'),
            ], 'lang');*/

            // Registering package commands.
             $this->commands([
                'Sayedsoft\Dex\Base\Commands\DexInitCommand',
                'Sayedsoft\Dex\WalletDeposit\Commands\CheckWalletsDepositCommand',

             ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'dex');

        // Register the main class to use with the facade
        $this->app->singleton('dex', function () {
            return new Dex;
        });

        // Register events
    }
}
