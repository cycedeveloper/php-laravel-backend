<?php
namespace Sayedsoft\Dex\Base\Commands;



use Illuminate\Console\Command;
use Sayedsoft\Dex\Token\Models\Token;

class DexTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dex:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dex test for dev';

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
        Token::all();
        return 0;
    }
}
