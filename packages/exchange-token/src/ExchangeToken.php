<?php

namespace Sayedsoft\ExchangeToken;

use Sayedsoft\ExchangeToken\Exchange\Helpers\FeeCalculator;
use Sayedsoft\ExchangeToken\Exchange\Order;

class ExchangeToken
{   

    public static function Order () {
         return new Order();
    }

    public static function FeeCalulator () {
        return new FeeCalculator();
    }

    public static function Accouting () {
      return new FeeCalculator();
    }

}
