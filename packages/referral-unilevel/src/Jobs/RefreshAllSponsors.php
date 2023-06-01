<?php

namespace Sayedsoft\ReferralUnilevel\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sayedsoft\Dex\Base\Jobs\TelegramJob;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelUserReferral;
use Sayedsoft\ReferralUnilevel\Helpers\NewChild;
use Sayedsoft\ReferralUnilevel\Jobs\RefreshChildsTemp;
use Sayedsoft\ReferralUnilevel\Models\Referral\ReferralSponsor;

class RefreshAllSponsors implements ShouldQueue
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
        $referral = new UnilevelUserReferral(215);
        $parentsTree = $referral->parentsTree;
        $parentsTree->rebuild();
        $sponsors = $parentsTree->set()->asOneList()->get();
        foreach ($sponsors as $sponsor) {
            RefreshChildsTemp::dispatch($sponsor->user)->onQueue('referral');
        }
    }
}
