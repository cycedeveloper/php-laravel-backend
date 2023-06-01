<?php
namespace Sayedsoft\ReferralIncome\Observers;


use Sayedsoft\ReferralIncome\Models\ReferralIncomeModel;
use Sayedsoft\StakeToken\Career\UserCareerResponse;

class ReferralIncomeObserve
{

    public function created(ReferralIncomeModel $income)
    {   
         $income->refreshTotal();

        $career = new UserCareerResponse();
        $career->rebuild($income->user_id);
    }

    public function updated(ReferralIncomeModel $income)
    {
        //
        $income->refreshTotal();

       $career = new UserCareerResponse();
        $career->rebuild($income->user_id);
    }


    public function deleted(ReferralIncomeModel $income)
    {
        //
        $income->refreshTotal();
    }

    public function restored(ReferralIncomeModel $income)
    {
        //
        $income->refreshTotal();
    }
    

    public function forceDeleted(ReferralIncomeModel $income)
    {
        //
        $income->refreshTotal();
    }
}
