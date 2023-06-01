<?php
namespace Sayedsoft\Dex\Accounting\Observers;

use Sayedsoft\Dex\Accounting\Models\AccountingTotal;

class AccountingTotalObserve
{
    
    public $afterCommit = true;

    function updateBalance (AccountingTotal $accountingTotal) {
        if ($accountingTotal->amount > 0) {
            $accountingTotal->user->balanceToken($accountingTotal->token_id)->refresh();
        }
    }
   
    /**
     * Handle the AccountingTotal "created" event.
     *
     * @param  \App\Models\Accounting\AccountingTotal  $accountingTotal
     * @return void
     */
    public function created(AccountingTotal $accountingTotal)
    {
        //
        
        if ($accountingTotal->amount > 0) {
            $accountingTotal->user->balanceToken($accountingTotal->token_id)->refresh();
        }
        
    }

    /**
     * Handle the AccountingTotal "updated" event.
     *
     * @param  \App\Models\Accounting\AccountingTotal  $accountingTotal
     * @return void
     */
    public function updated(AccountingTotal $accountingTotal)
    {
        //
        if ($accountingTotal->amount > 0) {
            $accountingTotal->user->balanceToken($accountingTotal->token_id)->refresh();
        }
    }

    /**
     * Handle the AccountingTotal "deleted" event.
     *
     * @param  \App\Models\Accounting\AccountingTotal  $accountingTotal
     * @return void
     */
    public function deleted(AccountingTotal $accountingTotal)
    {
        //
        if ($accountingTotal->amount > 0) {
            $accountingTotal->user->balanceToken($accountingTotal->token_id)->refresh();
        }
    }

    /**
     * Handle the AccountingTotal "restored" event.
     *
     * @param  \App\Models\Accounting\AccountingTotal  $accountingTotal
     * @return void
     */
    public function restored(AccountingTotal $accountingTotal)
    {
        //
        if ($accountingTotal->amount > 0) {
            $accountingTotal->user->balanceToken($accountingTotal->token_id)->refresh();
        }
    }

    /**
     * Handle the AccountingTotal "force deleted" event.
     *
     * @param  \App\Models\Accounting\AccountingTotal  $accountingTotal
     * @return void
     */
    public function forceDeleted(AccountingTotal $accountingTotal)
    {
        //
        if ($accountingTotal->amount > 0) {
            $accountingTotal->user->balanceToken($accountingTotal->token_id)->refresh();
        }
    }
}
