<?php
namespace Sayedsoft\StakeToken\Validations;

class UserBanalceValidate {


    public static function validate ($stake) {
        

        $balance = $stake->getUser()->balanceToken($stake->getToken()->id);
        if ($balance->balance < $stake->getAmount()) {
            $stake->returnError('Insufficient balance ');
        }
        
    }

}