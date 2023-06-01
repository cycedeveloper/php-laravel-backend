<?php
namespace Sayedsoft\ExchangeToken\Exchange\Validations;

class UserBanalceValidate {


    public static function validate ($order) {
        $balance = $order->user->balanceToken($order->sold_token->id);
        if ($balance->balance < $order->getSoldAmount()) {
            $order->returnError('Insufficient balance '.$order->sold_token->token_code.' to '.$order->getSoldAmount());
        }
        
    }

}