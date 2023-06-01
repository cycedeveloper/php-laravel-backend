<?php

namespace Sayedsoft\StakeToken\Observes;

use Sayedsoft\StakeToken\Career\CareerAccounting;
use Sayedsoft\StakeToken\Models\Career\UserCareerProfits;

class CareerProfitObserve
{
    //

    public function created(UserCareerProfits $profit)
    {
        //
        $w =  new  CareerAccounting(1,$profit->user_id);
        $w->refreshTotals();
    }

}