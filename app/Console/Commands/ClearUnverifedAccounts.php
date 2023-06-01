<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ClearUnverifedAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unverifedaccounts:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'unverifedaccounts';

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
         $results = User::whereNull('email_verified_at')->get();
        $results = $results
            ->where('created_at', '<', Carbon::now()->subDays(1)->toDateTimeString());

        foreach ($results as $result)
        {
            $result->delete();
        }
        return 0;
    }
}
