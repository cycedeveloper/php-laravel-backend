<?php
namespace Sayedsoft\ReferralIncome;

use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\Dex\Accounting\BaseAccounting;
use Sayedsoft\ReferralIncome\Models\ReferralIncomeModel;

class ReferralIncomeAccounting  {

    use BaseAccounting;

    private function calculateTotal () {
        return ReferralIncomeModel::where('user_id',$this->_user)
        ->where('token_id',$this->_token)
        ->groupBy('user_id')
        ->selectRaw('user_id, sum(amount) as total')->first();
    }


    public function refreshTotals()
    {   
        $ref = $this->calculateTotal();
        $refTotal = (!$ref)  ? 0 : $ref->total;
        Accounting::of('REFERRALINCOME',$this->_token,$this->_user)->set($refTotal);
     
        return [
            'ref'=>$refTotal,
        ];
    }
    
   

}