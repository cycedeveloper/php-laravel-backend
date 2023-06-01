<?php
namespace Sayedsoft\Dex\WalletDeposit\Observers;

use Sayedsoft\Dex\WalletDeposit\Jobs\WalletDepositNotifyJob;
use Sayedsoft\Dex\WalletDeposit\Models\PaymentWalletsDeposit;

class WalletDepositObserve
{
    
    public function created(PaymentWalletsDeposit $paymentWalletsDeposit)
    {   
          $paymentWalletsDeposit->refreshTotal();

         // Send notification
         WalletDepositNotifyJob::dispatch($paymentWalletsDeposit)->delay(\Carbon\Carbon::now()->addSeconds(10));
    }

    public function updated(PaymentWalletsDeposit $paymentWalletsDeposit)
    {
        //
        $paymentWalletsDeposit->refreshTotal();
    }

    /**
     * Handle the PaymentWalletsDeposit "deleted" event.
     *
     * @param  \App\Models\Payment\PaymentWalletsDeposit  $paymentWalletsDeposit
     * @return void
     */
    public function deleted(PaymentWalletsDeposit $paymentWalletsDeposit)
    {
        //
        $paymentWalletsDeposit->refreshTotal();
    }

    /**
     * Handle the PaymentWalletsDeposit "restored" event.
     *
     * @param  \App\Models\Payment\PaymentWalletsDeposit  $paymentWalletsDeposit
     * @return void
     */
    public function restored(PaymentWalletsDeposit $paymentWalletsDeposit)
    {
        //
        $paymentWalletsDeposit->refreshTotal();
    }

    /**
     * Handle the PaymentWalletsDeposit "force deleted" event.
     *
     * @param  \App\Models\Payment\PaymentWalletsDeposit  $paymentWalletsDeposit
     * @return void
     */
    public function forceDeleted(PaymentWalletsDeposit $paymentWalletsDeposit)
    {
        //
        $paymentWalletsDeposit->refreshTotal();
    }
}
