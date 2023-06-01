<?php

namespace Sayedsoft\ExchangeToken\Exchange\Helpers;

use Sayedsoft\Dex\Base\Helpers\NF;
use Sayedsoft\ExchangeToken\Models\ExchangePairs;

class CurrencyConvert {
    
     
     public static function calculate ($price,$amount) {
         if ($price == null) return ;
         return NF::set(($amount * $price));
     }

     public static function convert ($price,$amount,$type) {
        if ($price == null) return 0;
        if ($type == 'BUY') {
            return NF::set(((float)$amount / (float)$price));
        } else {
            return NF::set(((float)$amount * (float)$price));
        }
    }

    public static function convertTo ($amount,$token_id,$to = 'default') {
        
        $pair = ExchangePairs::where('quote_asset',$token_id)->orWhere('base_asset',$token_id)->first();

        if (!isset($pair)) {
            return 0;
        }

        if ($pair->base_asset == $token_id) {
            return NF::set( $amount);
        } 
        

        if ($pair->quote_asset == $token_id) {
            return self::convert($pair->price,$amount,'SELL');
        }
    }
}
