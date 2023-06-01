<?php

namespace Sayedsoft\ReferralUnilevel;
use Sayedsoft\ReferralUnilevel\Core\Errors\ReturnErrorTrait;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelDefaultAanalyzer;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelReferralDetails;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelUserReferral;




class Unilevel
{    
    use ReturnErrorTrait;


    /**
     * $user_id - The user
     * User model
     * or $user_id
     */

    
    public static function ReferralOf ($user_id) {
        $user =  new UnilevelUserReferral($user_id);
        return $user;
    }

    public static function DetailsOf ($user_id) {
        $details =  new UnilevelReferralDetails($user_id);
        return $details->get();
    }


    public static function Tempers ($user_id) {
        $tempers = BinaryTempers::class;
        $tempers::setUserId($user_id);
        return $tempers;
    } 

    public static function Analyzers ($user_id) {
        $analyzer = new UnilevelDefaultAanalyzer($user_id);        
        return $analyzer;
    }

    public static function RebuildEveryThing () {
      //  RebuildEveryThing::run();
    }



    
    
}
