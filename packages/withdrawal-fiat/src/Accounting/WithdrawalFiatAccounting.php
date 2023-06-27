<?php
namespace Sayedsoft\DexwithdrawalFiat\Accounting;

use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\Dex\Accounting\BaseAccounting;
use Sayedsoft\DexwithdrawalFiat\Models\withdrawalFiat;

class withdrawalFiatAccounting  {

    use BaseAccounting;

    private function calculateTotal() {
        $total = withdrawalFiat::where('token_id',$this->_token)
        ->where('user_id',$this->_user)
        ->whereIn('status',['pending','confirmed'])
        ->groupBy('user_id')
        ->selectRaw('user_id,token_id,amount,amount_fee  , sum(amount) as total_f')->first();
        if (isset($total->total_f)) { return $total->total_f; } else { return 0; }
    }
    
    public function refreshTotals()
    {   
        $total = $this->calculateTotal();
        Accounting::of('WITHDRAW',$this->_token,$this->_user)->set($total);
    }
    
   

}