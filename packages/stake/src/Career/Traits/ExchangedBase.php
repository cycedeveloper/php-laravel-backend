<?php

namespace Sayedsoft\StakeToken\Career\Traits;

use Sayedsoft\ExchangeToken\Exchange\Helpers\CurrencyConvert;
use stdClass;

class ExchangedBase
{
    private $baseAmount = 0;

    private $quoteAmount = 0;

    private $baseToken;

    private $quoteToken;

    public $result;

    public $from = 'qoute';

    public function __construct($amount, $quoteToken, $from = 'qoute', $baseToken = 1)
    {
        $this->result = new stdClass();
        if ($from == 'qoute') {
            $this->quoteAmount = $amount;
            $this->baseAmount = $amount;
        } elseif ($from == 'base') {
            $this->quoteAmount = $amount;
            $this->baseAmount = $amount;
        }

        $this->baseToken = $baseToken;
        $this->quoteToken = $quoteToken;
        $this->from = $from;
    }


    private function convert()
    {
        if ($this->from == 'qoute') {
            $this->baseAmount = CurrencyConvert::convertTo($this->baseAmount, $this->quoteToken);
        } elseif ($this->from == 'base') {
            $this->baseAmount = CurrencyConvert::convertTo($this->baseAmount, $this->quoteToken, $this->quoteToken);
        }
    }


    private function setResult()
    {
        $this->convert();

        $this->result->quoteAmount =  $this->quoteAmount;

        $this->result->baseAmount =  $this->baseAmount;

        $this->result->baseToken =  $this->baseToken;

        $this->result->quoteToken =  $this->quoteToken;


        return $this;
    }

    public function get()
    {
        $this->setResult();


        return $this->result;
    }
}
