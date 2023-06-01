<?php
namespace Sayedsoft\Dex\WalletDeposit\Libraries;

use App\Models\User;
use Sayedsoft\Dex\Token\Models\Token;
use Sayedsoft\Dex\WalletDeposit\Models\PaymentWalletsDeposit;

class SaveWalletDeposits
{
    


    private $payment_wallets_deposit = [];
    
    /**
     * Set income data
     */

    public function __construct()
    {
        
    }

    public function user ($user_id) {
        $this->payment_wallets_deposit['user_id'] = $user_id; return $this;
    }

    public function wallet ($wallet_id ) {
        $this->payment_wallets_deposit['wallet_id'] = $wallet_id; return $this;
    }

    public function token ($token_id ) {
        $this->payment_wallets_deposit['token_id'] = $token_id; return $this;
    }

    public function amount ($amount ) {
        $this->payment_wallets_deposit['amount'] = $amount; return $this;
    }

    public function transaction ($transaction_id ) {
        $this->payment_wallets_deposit['transaction_id'] = $transaction_id; return $this;
    }
    

     /**
     * Income Functions
     */
    private function validate () {
        if (
            $this->payment_wallets_deposit['amount'] <= 0 ||
            !User::whereId($this->payment_wallets_deposit['user_id'])->exists() ||
            !Token::whereId($this->payment_wallets_deposit['token_id'])->exists()
           ) return false;
           return true;
    }

    public function save () {
        if (!$this->validate()) return false;
        return PaymentWalletsDeposit::create($this->payment_wallets_deposit);
    }

   

}
