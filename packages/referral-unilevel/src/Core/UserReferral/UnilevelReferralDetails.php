<?php

namespace Sayedsoft\ReferralUnilevel\Core\UserReferral;

use App\Models\User;
use Exception;

use Sayedsoft\ReferralUnilevel\Core\Errors\ReturnErrorTrait;
use Sayedsoft\ReferralUnilevel\Models\Referral\Referral;
use Sayedsoft\ReferralUnilevel\Traits\Referral\UserSetter;
use stdClass;

Class UnilevelReferralDetails {

    use UserSetter;

    use ReturnErrorTrait;


    private $referral;

    public function __construct($user) {
        $this->setUser($user);
        $this->init();
    }
    
    private function _baseModelCall () {
        return Referral::select(['user_id','referral_id']);
    }
    
    private function init () {
        $referral = $this->_baseModelCall()->where('user_id', $this->getUserId())->first();
        if (empty($referral)) {
            return $this->returnError('User not found.');
        }
        $this->referral = $referral;
    }

    private function parent () {
        return isset($this->referral->referral_id) ? $this->referral->referral_id : null;
    }

    private function hasParnet () {
        return ($this->parent() !== null) ? true : false;
    }
    

    public function childs () {
        $childs = $this->_baseModelCall()->where('referral_id', $this->getUserId())->orderBy('created_at','asc')->get();
        $_childs = new stdClass();
        foreach ($childs as $child) {
            $id = $child->user_id;
            $_childs->$id = $id;
        }
        return $_childs;
    }

    public function asRow () {

        $user = new stdClass();

        $user->user = $this->getUserId();

        $user->parent = $this->parent();

        $user->childs = $this->childs();

       // $user->level = $this->referral->level;
             
        return $user;
    }

    public function get () {
         
        return $this;
    }


}