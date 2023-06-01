<?php

namespace Sayedsoft\StakeToken\Observes;

use Sayedsoft\StakeToken\Helpers\StakeAccounting;
use Sayedsoft\StakeToken\Jobs\StakeCreatedNotifyJob;
use Sayedsoft\StakeToken\Jobs\StakeStatusNotifyJob;
use Sayedsoft\StakeToken\Models\Stake;
use Sayedsoft\StakeToken\Models\StakeDetails;

class StakeDetailsObserve
{

    public function created(StakeDetails $stake)
    {
        //
    
    }


    public function updated(StakeDetails $stake)
    {
        //

        $stake->stake->refreshTotal();

    }

   
}
