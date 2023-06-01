<?php
namespace Sayedsoft\Dex\Base\Commands;



use Illuminate\Console\Command;
use Sayedsoft\Dex\Token\Models\Token;

class DexInitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dex:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dex install default db etc...';

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
        Token::create([
            'token_code' => 'USDT',
            'token_name' => 'USDT',
            'contract_address' => 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t',
            'contract_address_test' => 'TBgs5LC9haaHJChdd423sBHvdEVX82Mga5',
            'blockchain' => 'TRC20',
            'is_default' => '0',
            'payable' => '0',
            'withdrawable' => '0',
            'disabled' => '0',
        ]);
    }
}
