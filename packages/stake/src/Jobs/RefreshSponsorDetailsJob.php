<?php

namespace Sayedsoft\StakeToken\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelUserReferral;
use Sayedsoft\ReferralUnilevel\Jobs\RefreshAllSponsors;
use Sayedsoft\ReferralUnilevel\Unilevel;
use Sayedsoft\StakeToken\Notifications\StakeStatusNotify;

class RefreshSponsorDetailsJob implements ShouldQueue
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
        $unilevel =  Unilevel::Analyzers($this->user);
        $unilevel->analyze();
        $unilevel->rebuild();


        $referral = new UnilevelUserReferral($this->user);
        $childsTree = $referral->childsTree;
        $childsTree->rebuild();
    }
}
