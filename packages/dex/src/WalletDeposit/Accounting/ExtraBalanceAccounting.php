<?php
namespace Sayedsoft\Dex\WalletDeposit\Accounting;

use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\Dex\Accounting\BaseAccounting;
use Sayedsoft\Dex\WalletDeposit\Models\ExtraBalance;

class ExtraBalanceAccounting  {

    use BaseAccounting;

    private function calculateTotal($type) {
        $total = ExtraBalance::where('token_id',$this->_token)
        ->where('user_id',$this->_user)
        ->where('type',$type)
        ->groupBy('user_id')
        ->selectRaw('user_id,token_id, sum(amount) as total')->first();
         if (isset($total->total)) { return $total->total; } else { return 0; }
    }

    public function refreshTotals()
    {   
        $totalOut = $this->calculateTotal('OUT');
        Accounting::of('EXTRABALANCEOUT',$this->_token,$this->_user)->set($totalOut);

        $totalIN = $this->calculateTotal('IN');
        Accounting::of('EXTRABALANCEIN',$this->_token,$this->_user)->set($totalIN);
    }
    
   

}