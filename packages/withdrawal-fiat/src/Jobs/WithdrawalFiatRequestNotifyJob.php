<?php
namespace Sayedsoft\DexwithdrawalFiat\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sayedsoft\Dex\WalletDeposit\Notifications\WalletDepositRecived;
use Sayedsoft\DexwithdrawalFiat\Notifications\withdrawalFiatRequestRecived;

class withdrawalFiatRequestNotifyJob implements ShouldQueue 
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    /**
     * Create a new job instance.
     *  
     * @return void
     */

    protected $withdraw;
    
    public function __construct($withdraw)
    {
        //
        $this->withdraw = $withdraw;
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
        $this->withdraw->user->notify((new withdrawalFiatRequestRecived($this->withdraw))->afterCommit());
    }
}
