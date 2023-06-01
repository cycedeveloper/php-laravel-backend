<?php
namespace Sayedsoft\Dex\WalletDeposit\Observers;

use Sayedsoft\Dex\WalletDeposit\Jobs\WalletDepositNotifyJob;
use Sayedsoft\Dex\WalletDeposit\Models\ExtraBalance;

class ExtraBalanceObserve
{
    
    public function created(ExtraBalance $ExtraBalance)
    {   
          $ExtraBalance->refreshTotal();

    }

    public function updated(ExtraBalance $ExtraBalance)
    {
        //
        $ExtraBalance->refreshTotal();
    }

    /**
     * Handle the ExtraBalance "deleted" event.
     *
     * @param  \App\Models\Payment\ExtraBalance  $ExtraBalance
     * @return void
     */
    public function deleted(ExtraBalance $ExtraBalance)
    {
        //
        $ExtraBalance->refreshTotal();
    }

    /**
     * Handle the ExtraBalance "restored" event.
     *
     * @param  \App\Models\Payment\ExtraBalance  $ExtraBalance
     * @return void
     */
    public function restored(ExtraBalance $ExtraBalance)
    {
        //
        $ExtraBalance->refreshTotal();
    }

    /**
     * Handle the ExtraBalance "force deleted" event.
     *
     * @param  \App\Models\Payment\ExtraBalance  $ExtraBalance
     * @return void
     */
    public function forceDeleted(ExtraBalance $ExtraBalance)
    {
        //
        $ExtraBalance->refreshTotal();
    }
}
