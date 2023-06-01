<?php

namespace Sayedsoft\ReferralUnilevel\Traits\Referral;

use App\Models\User;
use Exception;

trait UserSetter {

    private $user;

    private $user_id;

    private $user_setted;
    

    
    /**
     * Get the value of _user
     */  
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of _user_id
     *
     * @return  self
     */ 
    public function setUser($_user)
    {      
        if ($_user instanceof User) {
            $this->user = $_user;

            $this->user_id = $_user->id;

            $this->user_setted = true;

            return $this;
        }
        
        $this->user = User::find($_user);

        if ($this->user == null) {
            throw new Exception('user not found! '.$_user);
        }

        $this->user_id = $this->user->id;

        $this->user_setted = true;


        return $this;
    }

    /**
     * Get the value of user_setted
     */ 
    private function getUserSetted()
    {
        return $this->user_setted;
    }

    private function checkUser () {
         if (!$this->getUserSetted()) {
            throw new Exception('You must set the user');
        }
    }

    /**
     * Get the value of user_id
     */ 
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    private function setUserId($user_id)
    {
        $this->user_id = $user_id;
        
        return $this;
    }
}