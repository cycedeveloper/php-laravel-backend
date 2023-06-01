<?php

namespace Sayedsoft\StakeToken\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sayedsoft\ReferralUnilevel\Unilevel;
use Sayedsoft\StakeToken\Career\UserCareer;
use Sayedsoft\StakeToken\Career\UserCareerResponse;
use Sayedsoft\StakeToken\Notifications\StakeStatusNotify;

class RefreshCareerJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public $after_commit = false;



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
        $c = new UserCareer($this->user);
        $c->get(true);


        $career = new UserCareerResponse();
        $career->rebuild($this->user);
    }
}
