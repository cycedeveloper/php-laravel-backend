<?php
namespace Sayedsoft\DexwithdrawalFiat\Observers;


use Sayedsoft\Dex\WalletDeposit\Jobs\WalletDepositNotifyJob;
use Sayedsoft\Dex\WalletDeposit\Models\PaymentWalletsDeposit;
use Sayedsoft\DexwithdrawalFiat\Jobs\withdrawalFiatRequestNotifyJob;
use Sayedsoft\DexwithdrawalFiat\Models\withdrawalFiat;

class withdrawalFiatRequestObserve
{

    public function created(withdrawalFiat $withdraw)
    {   
         $withdraw->refreshTotal();
        // Send notification
         withdrawalFiatRequestNotifyJob::dispatch($withdraw)->afterCommit()->delay(\Carbon\Carbon::now()->addSeconds(10));
    }

    public function updated(withdrawalFiat $withdraw)
    {
        //
        $withdraw->refreshTotal();
    }


    public function deleted(withdrawalFiat $withdraw)
    {
        //
        $withdraw->refreshTotal();
    }

    public function restored(withdrawalFiat $withdraw)
    {
        //
        $withdraw->refreshTotal();
    }
    

    public function forceDeleted(withdrawalFiat $withdraw)
    {
        //
        $withdraw->refreshTotal();
    }
}
