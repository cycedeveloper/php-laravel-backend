<?php

namespace Sayedsoft\ExchangeToken\Exchange;

use Exception;
use Sayedsoft\ExchangeToken\Exchange\Order\Amounts;
use Sayedsoft\ExchangeToken\Exchange\Order\Details;
use Sayedsoft\ExchangeToken\Exchange\Order\Fee;
use Sayedsoft\ExchangeToken\Exchange\Order\OrderValidate;
use Sayedsoft\ExchangeToken\Exchange\Order\Preview;
use Sayedsoft\ExchangeToken\Exchange\Order\Save;

class Order
{   
    use Details,
    Amounts,
    Fee,
    OrderValidate,
    Preview,
    Save;

    private $inited = false;

    public function  __construct(){}   

    public function init () {

        if ($this->inited) return $this;

        // init amounts
        $this->initAmounts();

        $this->inited = true;        
    }

    public function save () {

        $this->init();

        $this->validate();

        try {
           return $this->saveDB();
        } catch (\Throwable $th) {
            throw $th;
        }

    }


    public function returnError ($message) {
        throw new Exception($message, 1);
    }
   
}
