<?php
namespace Sayedsoft\StakeToken\Stake;

use App\Models\User;
use Sayedsoft\StakeToken\Helpers\StakePeriods;
use Sayedsoft\StakeToken\Models\StakesPlan;

trait Details {

    private $user, $plan, $user_id , $token;

    private $details;

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


    /**
     * Get the value of plan
     */ 
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * Set the value of plan
     *
     * @return  self
     */ 
    public function setPlan($plan)
    {   

        $plan = StakesPlan::find($plan);
        if (empty($plan) || !$plan->active) {
            return $this->returnError('plan not found');
        }

        $this->plan    = $plan;

        $this->token  =  $plan->token;

        return $this;
    }




    /**
     * Get the value of details
     */ 
    public function getDetails()
    {   

        return $this->details;
    }

    /**
     * Get the value of token_id
     */ 
    public function getToken()
    {
        return $this->token;
    }
}