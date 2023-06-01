<?php
namespace Sayedsoft\StakeToken\Validations;

class StakeAmountValidate {


    public static function validate ($order) {
        
        $plan   = $order->getPlan();

        $amount = $order->getAmount();


        if ($amount < $plan->min_amount) {
            $order->returnError('Min stake amount must be higher from '.$plan->min_amount);
        } 

        if ($amount > $plan->max_amount) {
            $order->returnError('Max stake amount must be higher from '.$plan->max_amount);
        } 

    }

}