<?php
namespace Sayedsoft\DexwithdrawalFiat\validations;

class UserBanalceValidate {


    public static function validate ($withdraw) {
        $balance = $withdraw->user->balanceToken($withdraw->token_id);
        if ( $withdraw->amount > $balance->balance ) {
            $withdraw->returnError('Insufficient balance ');
        }
    }
 
}