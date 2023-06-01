<?php

namespace Sayedsoft\ReferralIncome;

use Sayedsoft\ReferralIncome\Income\CreateReferralIncome;

class ReferralIncome
{

    

    public static function set ($user_id,$token_id,$related_id,$amount,$type) {
        $create = new CreateReferralIncome();
        $create->setUser($user_id);
        $create->setToken($token_id);
        $create->setRelatedId($related_id);
        $create->setAmount($amount);
        $create->setType($type);
        $create->save();
    }
}
