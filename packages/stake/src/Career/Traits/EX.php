<?php

namespace Sayedsoft\StakeToken\Career\Traits;

use Sayedsoft\StakeToken\Career\Traits\ExchangedBase;

class EX
{
    public static function nu($amount, $quoteToken, $from = 'qoute', $baseToken = 1)
    {
        $exchanged = new ExchangedBase($amount, $quoteToken, $from, $baseToken);
        return $exchanged->get();
    }
}
