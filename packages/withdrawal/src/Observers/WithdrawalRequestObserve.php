<?php
namespace Sayedsoft\DexWithdrawal\Observers;


use Sayedsoft\Dex\WalletDeposit\Jobs\WalletDepositNotifyJob;
use Sayedsoft\Dex\WalletDeposit\Models\PaymentWalletsDeposit;
use Sayedsoft\DexWithdrawal\Jobs\WithdrawalRequestNotifyJob;
use Sayedsoft\DexWithdrawal\Models\Withdrawal;

class WithdrawalRequestObserve
{

    public function created(Withdrawal $withdraw)
    {   
         $withdraw->refreshTotal();
        // Send notification
         WithdrawalRequestNotifyJob::dispatch($withdraw)->afterCommit()->delay(\Carbon\Carbon::now()->addSeconds(10));
    }

    public function updated(Withdrawal $withdraw)
    {
        //
        $withdraw->refreshTotal();
    }


    public function deleted(Withdrawal $withdraw)
    {
        //
        $withdraw->refreshTotal();
    }

    public function restored(Withdrawal $withdraw)
    {
        //
        $withdraw->refreshTotal();
    }
    

    public function forceDeleted(Withdrawal $withdraw)
    {
        //
        $withdraw->refreshTotal();
    }
}
