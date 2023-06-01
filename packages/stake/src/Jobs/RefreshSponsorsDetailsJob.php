<?php

namespace Sayedsoft\StakeToken\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sayedsoft\StakeToken\Notifications\StakeStatusNotify;

class RefreshSponsorsDetailsJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $after_commit = true;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $user;

    public function __construct($user)
    {
        //
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $newUser  = User::find($this->user);
        $sponsors = $newUser->referral->sponsors;

        foreach ($sponsors as $level => $sponsor) {
            RefreshSponsorDetailsJob::dispatch($sponsor->id)->onQueue('referral');
        }
    }
}
