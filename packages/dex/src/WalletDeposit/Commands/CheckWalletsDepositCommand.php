<?php
namespace Sayedsoft\Dex\WalletDeposit\Commands;




use Illuminate\Console\Command;
use Sayedsoft\Dex\WalletDeposit\Libraries\Blockchains\Tron\WalletDepositsScan;

use Sayedsoft\Dex\WalletDeposit\Models\PaymentWallet;

class CheckWalletsDepositCommand extends Command
{   
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wallets:checksdeposits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Wallets Deposit';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        $wallets = PaymentWallet::get();
        foreach($wallets as $wallet) {
            WalletDepositsScan::scan($wallet);
        }
        
    }
}
