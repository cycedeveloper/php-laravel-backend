<?php
namespace Sayedsoft\StakeToken\Stake;

use App\Models\User;
use Sayedsoft\StakeToken\Models\StakesPlan;

trait StakeAmounts {

    private $amount;

    private $amount_setted = false;

    public function getAmount()
    {
        return (float) $this->amount;
    }


    public function setAmount($amount)
    {
        $this->amount = $amount;

        $this->amount_setted = true;

        return $this;
    }
    
    
}