<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use App\Nova\Metrics\Deposited,App\Nova\Metrics\StakeConfirmed,
App\Nova\Metrics\StakeUnconfirmed, App\Nova\Metrics\WithdrawnConfirmed, App\Nova\Metrics\WithdrawnUnconfirmed ;
use App\Nova\Metrics\Deposits;
use App\Nova\Metrics\PendingStake;
use App\Nova\Metrics\PendingWithdrawals;
use App\Nova\Metrics\ReferanceEarnings;
use App\Nova\Metrics\Staked;
use App\Nova\Metrics\StakeEarnings;
use App\Nova\Metrics\UsersCount;
use App\Nova\Metrics\WalletDeposits;
use App\Nova\Metrics\Withdrawals;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        
       \Outl1ne\NovaSettings\NovaSettings::addSettingsFields([

            Panel::make('Levels ', [
                Text::make('1. level', 'ref_1'),
                Text::make('2. level', 'ref_2'),
                Text::make('3. level', 'ref_3'),
                Text::make('4. level', 'ref_4'),
                Text::make('5. level', 'ref_5'),
                Text::make('6. level', 'ref_6'),
                Text::make('7. level', 'ref_7'),
            ])

            /*
            Panel::make('Global settings', [
                Number::make('Min Stake Amount (U2)', 'min_stake'),
                Number::make('Min Withdraw Amount (USDT)', 'min_withdraw'),
            ]),
            
            ,

            Panel::make('Exchange', [
                Number::make('Min Exchange amount (USDT)', 'min_tradable'),
                Number::make('Max Exchange amount (USDT)','min_tradable'),
                Text::make('U2 Token price', 'token_price'),
            ]),
            */
        ],[], 'Referral Settings');

        

    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [


        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
             new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
          new \Outl1ne\NovaSettings\NovaSettings
        ];
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
