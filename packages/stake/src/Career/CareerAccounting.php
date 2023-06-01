<?php

namespace Sayedsoft\StakeToken\Career;

use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\Dex\Accounting\BaseAccounting;
use Sayedsoft\StakeToken\Models\Career\UserCareerProfits;

class CareerAccounting
{
    use BaseAccounting;

    private function calculateTotalProfits()
    {
        return UserCareerProfits::where('user_id', $this->_user)
        ->groupBy('user_id')
        ->selectRaw('user_id, sum(amount) as total')->first();
    }



    public function refreshTotals()
    {
        $profits = $this->calculateTotalProfits();
        $profitsTotal = (!$profits) ? 0 : $profits->total;
        Accounting::of('CAREERPROFIT', 1, $this->_user)->set($profitsTotal);

        return [
            'totalprofits'=>$profitsTotal,
        ];
    }
}
