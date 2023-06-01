<?php

namespace Sayedsoft\ReferralUnilevel\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sayedsoft\Dex\Base\Jobs\TelegramJob;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelDefaultAanalyzer;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelUserReferral;
use Sayedsoft\ReferralUnilevel\Helpers\NewChild;
use Sayedsoft\ReferralUnilevel\Models\Referral\ReferralSponsor;
use Sayedsoft\StakeToken\Jobs\RefreshCareerJob;

class RefreshChildsTemp implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $referral = new UnilevelUserReferral($this->user);
        $childsTree = $referral->childsTree;
        $childsTree->rebuild();



        $analyzer = new UnilevelDefaultAanalyzer($this->user);
        $analyzer->rebuild();


        RefreshCareerJob::dispatch($this->user)->onQueue('career');
    }
}
