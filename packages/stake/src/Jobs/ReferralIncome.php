<?php

namespace Sayedsoft\StakeToken\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Sayedsoft\StakeToken\Helpers\SaveReferralIncome;
use Sayedsoft\StakeToken\Models\Stake;

class ReferralIncome implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $stake_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($stake_id)
    {
        //
        $this->stake_id = $stake_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $stake = Stake::find($this->stake_id);

        SaveReferralIncome::save($stake);
    }
}
