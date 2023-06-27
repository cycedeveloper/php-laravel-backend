<?php
namespace Sayedsoft\DexwithdrawalFiat\validations;

class WithdrawAmountValidate {


    public static function validate ($withdraw) {
        $min = 0.0000001; 
        if ($withdraw->settings != null) { 
            $min =  $withdraw->settings->min_amount; 
            $max =  $withdraw->settings->max_amount; 
            if ($withdraw->amount < $min) {
                $withdraw->returnError('Min withdraw amount must be higher from '.$min);
            } 

            if ($withdraw->amount > $max) {
                $withdraw->returnError('Max withdraw amount must be higher from '.$max);
            } 
        }
        
    }

}