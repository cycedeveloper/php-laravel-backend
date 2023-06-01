<?php

namespace Sayedsoft\Dex\Accounting\Observers;

use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\Dex\Accounting\Models\AccountingBalance;
use Sayedsoft\ReferralUnilevel\Jobs\RefreshAllSponsors;

class AccountingBalanceObserve
{
    public $afterCommit = true;

    /**
     * Handle the AccountingBalance "created" event.
     *
     * @param  \App\Models\Accounting\AccountingBalance  $accountingBalance
     * @return void
     */
    public function created(AccountingBalance $accountingBalance)
    {
        Accounting::temp_refresh($accountingBalance->user_id);
    }

    /**
     * Handle the AccountingBalance "updated" event.
     *
     * @param  \App\Models\Accounting\AccountingBalance  $accountingBalance
     * @return void
     */
    public function updated(AccountingBalance $accountingBalance)
    {
        //
        Accounting::temp_refresh($accountingBalance->user_id);

        // RefreshAllSponsors::dispatch($accountingBalance->user_id)->onQueue('balance');
    }

    /**
     * Handle the AccountingBalance "deleted" event.
     *
     * @param  \App\Models\Accounting\AccountingBalance  $accountingBalance
     * @return void
     */
    public function deleted(AccountingBalance $accountingBalance)
    {
        //
    }

    /**
     * Handle the AccountingBalance "restored" event.
     *
     * @param  \App\Models\Accounting\AccountingBalance  $accountingBalance
     * @return void
     */
    public function restored(AccountingBalance $accountingBalance)
    {
        //
    }

    /**
     * Handle the AccountingBalance "force deleted" event.
     *
     * @param  \App\Models\Accounting\AccountingBalance  $accountingBalance
     * @return void
     */
    public function forceDeleted(AccountingBalance $accountingBalance)
    {
        //
    }
}
