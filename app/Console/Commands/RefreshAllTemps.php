<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\StakeToken\Jobs\RefreshCareerJob;
use Sayedsoft\StakeToken\Jobs\RefreshSponsorDetailsJob;

class RefreshAllTemps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:temps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $users = User::all();

        foreach ($users as $user) {
            Accounting::temp_refresh($user->id);

            RefreshSponsorDetailsJob::dispatch($user->id)->onQueue('referral');

            RefreshCareerJob::dispatch($user->id)->onQueue('referral');
        }


        return 0;
    }
}
