<?php
namespace Sayedsoft\Dex\WalletDeposit\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sayedsoft\Dex\WalletDeposit\Notifications\WalletDepositRecived;

class WalletDepositNotifyJob implements ShouldQueue 
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    /**
     * Create a new job instance.
     *  
     * @return void
     */

    protected $deposit;
    
    public function __construct($deposit)
    {
        //
        $this->deposit = $deposit;
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
        $this->deposit->user->notify((new WalletDepositRecived($this->deposit))->afterCommit());
    }
}
