<?php
namespace Sayedsoft\Dex\WalletDeposit\Accounting;

use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\Dex\Accounting\BaseAccounting;
use Sayedsoft\Dex\WalletDeposit\Models\PaymentWalletsDeposit;

class WalletDepositAccounting  {

    use BaseAccounting;

    private function calculateTotal() {
        $total = PaymentWalletsDeposit::where('token_id',$this->_token)
        ->where('user_id',$this->_user)
        ->groupBy('user_id')
        ->selectRaw('user_id,token_id, sum(amount) as total')->first();
         if (isset($total->total)) { return $total->total; } else { return 0; }
    }

    public function refreshTotals()
    {   
        $total = $this->calculateTotal();
        Accounting::of('DEPOSIT',$this->_token,$this->_user)->set($total);
    }
    
   

}