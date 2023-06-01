<?php
namespace Sayedsoft\ExchangeToken\Exchange\Validations;

class OrderAmountValidate {


    public static function validate ($order) {
        
        $pair       = $order->getPair();

        $soldAmount = $order->getSoldAmount();


        if ($soldAmount < $pair->min_tradable) {
            $order->returnError('Min order amount must be higher from '.$pair->min_tradable);
        } 

        if ($soldAmount > $pair->max_tradable) {
            $order->returnError('Max order amount must be higher from '.$pair->max_tradable);
        } 

    }

}