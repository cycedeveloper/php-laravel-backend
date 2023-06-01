<?php

namespace Sayedsoft\StakeToken\Observes;

use Sayedsoft\ReferralUnilevel\Jobs\RefreshAllSponsors;
use Sayedsoft\StakeToken\Helpers\StakeAccounting;
use Sayedsoft\StakeToken\Jobs\RefreshCareerJob;
use Sayedsoft\StakeToken\Jobs\StakeCreatedNotifyJob;
use Sayedsoft\StakeToken\Jobs\StakeStatusNotifyJob;
use Sayedsoft\StakeToken\Models\Stake;

class StakeObserve
{
    public function created(Stake $stake)
    {
        //
        StakeCreatedNotifyJob::dispatch($stake);

        $stake->refreshTotal();
    }

    /**
     * Handle the Stake "updated" event.
     *
     * @param  \App\Models\Stake  $stake
     * @return void
     */
    public function updated(Stake $stake)
    {
        //

        StakeStatusNotifyJob::dispatch($stake, $stake->status);

        RefreshCareerJob::dispatch($stake->user_id);

        $stake->refreshTotal();
    }

    /**
     * Handle the Stake "deleted" event.
     *
     * @param  \App\Models\Stake  $stake
     * @return void
     */
    public function deleted(Stake $stake)
    {
        //

        $stake->refreshTotal();
    }

    /**
     * Handle the Stake "restored" event.
     *
     * @param  \App\Models\Stake  $stake
     * @return void
     */
    public function restored(Stake $stake)
    {
        //
    }

    /**
     * Handle the Stake "force deleted" event.
     *
     * @param  \App\Models\Stake  $stake
     * @return void
     */
    public function forceDeleted(Stake $stake)
    {
        //
    }
}
