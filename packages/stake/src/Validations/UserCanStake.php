<?php
namespace Sayedsoft\StakeToken\Validations;

use Sayedsoft\StakeToken\Models\Stake;

class UserCanStake {


    public static function validate ($stake) {

        $user_id = $stake->getUser()->id;

        $pending = Stake::whereUserId($user_id)->pending()->first();

        if (!empty($pending->id)) { 
            $stake->returnError('You have unconrimrd satke request.');
         }

    }

}