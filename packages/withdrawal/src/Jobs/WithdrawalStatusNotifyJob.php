<?php
namespace Sayedsoft\DexWithdrawal\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sayedsoft\Dex\WalletDeposit\Notifications\WalletDepositRecived;
use Sayedsoft\DexWithdrawal\Notifications\WithdrawalRequestRecived;
use Sayedsoft\DexWithdrawal\Notifications\WithdrawalStatusNotify;

class WithdrawalStatusNotifyJob implements ShouldQueue 
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *  
     * @return void
     */

    protected $withdraw;

    protected $status;
    
    public function __construct($withdraw,$status)
    {
        //
        $this->withdraw = $withdraw;

        $this->status = $status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        if (!config('dex.mailnotify')) { return; }
        $this->withdraw->user->notify((new WithdrawalStatusNotify($this->withdraw,$this->status))->afterCommit());
    }
}
