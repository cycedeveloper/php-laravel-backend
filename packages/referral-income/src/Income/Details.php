<?php
namespace Sayedsoft\ReferralIncome\Income;

use App\Models\User;
use Sayedsoft\Dex\Token\Models\Token;
use Sayedsoft\StakeToken\Helpers\StakePeriods;
use Sayedsoft\StakeToken\Models\StakesPlan;

trait Details {

    private $user, $user_id , $token,$token_id;

    private $related_id;

    private $amount;

    private $type;

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user_id)
    {
        $this->user    = User::find($user_id);
        if (empty($this->user)) {
            return $this->returnError('User not found');
        } 

        $this->user_id = $user_id;

        return $this;
    }


    public function setToken($token_id)
    {
        $this->token    = Token::find($token_id);
        if (empty($this->token)) {
            return $this->returnError('token not found');
        } 

        $this->token_id = $token_id;

        return $this;
    }


    /**
     * Get the value of related_id
     */ 
    public function getRelated_id()
    {
        return $this->related_id;
    }

    /**
     * Set the value of related_id
     *
     * @return  self
     */ 
    public function setRelatedId($related_id)
    {
        $this->related_id = $related_id;

        return $this;
    }

    /**
     * Get the value of amount
     */ 
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set the value of amount
     *
     * @return  self
     */ 
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}