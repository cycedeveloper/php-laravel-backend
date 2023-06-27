<?php
namespace Sayedsoft\DexwithdrawalFiat\validations;

use Sayedsoft\DexwithdrawalFiat\Models\withdrawalFiat;

class UserCanWithdraw {



    public static function validate ($withdraw) {
        $withdrawalFiat =  withdrawalFiat::for($withdraw->user_id,$withdraw->token_id)->pending()->first();
        if ($withdrawalFiat) {
            return $withdraw->returnError('Account has unconfirmed stake request. cancel it or wait to confirmtion by admin!');  
        } 
    }

}