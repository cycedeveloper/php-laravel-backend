<?php

namespace App\Nova\Dashboards;


use App\Nova\Metrics\PendingStake;
use App\Nova\Metrics\PendingWithdrawals;
use App\Nova\Metrics\ReferanceEarnings;
use App\Nova\Metrics\Staked;
use App\Nova\Metrics\StakeEarnings;
use App\Nova\Metrics\UsersCount;
use App\Nova\Metrics\WalletDeposits;
use App\Nova\Metrics\Withdrawals;

use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new UsersCount(),
            new WalletDeposits(),
            new Withdrawals(),
            new Staked(),
            new PendingWithdrawals(),
            new ReferanceEarnings(),
            new StakeEarnings(),
            new PendingStake(),
            /*
            new Deposited,
            new StakeConfirmed(),
            new StakeUnconfirmed(),
            new WithdrawnConfirmed(),
            new WithdrawnConfirmed(),
            */
        ];
    }
}