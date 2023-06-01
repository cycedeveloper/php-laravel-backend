<?php

namespace Sayedsoft\StakeToken\Career\Traits;

use Sayedsoft\Dex\Base\Helpers\NF;
use Sayedsoft\ExchangeToken\Exchange\Helpers\CurrencyConvert;

trait CareerMathTrait
{
    private function percentile($a, $b)
    {
        if ($a == 0 || $b == 0) {
            return 0;
        }
        if ($a < $b) {
            $_a = $a / $b;
        } else {
            $_a = $b / $a;
        }

        return NF::set($_a * 100, 2)   ;
    }
}
