<?php
namespace Sayedsoft\StakeToken\Commands;




use Illuminate\Console\Command;
use Sayedsoft\Dex\WalletDeposit\Libraries\Blockchains\Tron\WalletDepositsScan;
use Sayedsoft\StakeToken\Models\Stake;

class CheckStakeCommand extends Command
{   
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stake:checkall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check stake profits';

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
        $stakes = Stake::confirmed()->get();
        foreach($stakes as $stake) {
            $stake->stakeDetails->checkProfits();
        }
        
    }
}
