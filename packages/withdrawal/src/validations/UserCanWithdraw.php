<?php
namespace Sayedsoft\DexWithdrawal\validations;

use Sayedsoft\DexWithdrawal\Models\Withdrawal;

class UserCanWithdraw {



    public static function validate ($withdraw) {
        $Withdrawal =  Withdrawal::for($withdraw->user_id,$withdraw->token_id)->pending()->first();
        if ($Withdrawal) {
            return $withdraw->returnError('Account has unconfirmed stake request. cancel it or wait to confirmtion by admin!');  
        } 
    }

}