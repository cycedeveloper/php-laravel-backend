<?php

namespace Sayedsoft\StakeToken\Helpers;

use Sayedsoft\ReferralIncome\Income\CreateReferralIncome;

class SaveReferralIncome
{
    public static function save($stake)
    {
        $details = $stake->stakeDetails;
        $create = new CreateReferralIncome();
        $create->setUser($stake->user_id);
        $create->setToken($details->token_id);
        $create->setRelatedId($stake->id);
        $create->setAmount($stake->amount);
        $create->setType('stake');
        $create->save();
    }
}