<?php
namespace Sayedsoft\ExchangeToken\Exchange\Order;

use App\Models\User;
use Sayedsoft\Dex\Fees\FeeCalculator;
use Sayedsoft\ExchangeToken\Exchange\Helpers\CurrencyConvert;
use Sayedsoft\ExchangeToken\Models\ExchangePairs;

trait Amounts 
{


    private $base_amount = 0,$quote_amount = 0, $total = 0;

    private $base_amount_given = false , $quote_amount_given = false; 

    private $sold_amount = 0;

    private $amounts_inited = false;

    // Init
    private function initAmounts () {

        if($this->amounts_inited) return $this;

        if (!$this->base_amount_given &&  !$this->quote_amount_given) return $this->returnError('Order dont have amount');

        $this->setSoldAmount();

        $this->setFee();

        return $this;
    }


    /**
     * Get the value of base_amount
     */ 
    public function getBaseAmount()
    {
        return $this->base_amount;
    }

    /**
     * Set the value of base_amount
     *
     * @return  self
     */ 
    public function setBaseAmount($base_amount)
    {   

        if ($this->quote_amount_given) { 
            $this->returnError('quote_amount given');
        }

        if ($this->type == null || $this->pair == null) { 
            $this->returnError('set type and pair firstly');
        }


        $this->base_amount       = $base_amount;

        $this->quote_amount      = CurrencyConvert::convert($this->getPrice(),$base_amount,$this->gettype());
      
        $this->base_amount_given = true;

        return $this;
    }

    /**
     * Get the value of quote_amount
     */ 
    public function getQuoteAmount()
    {
        return $this->quote_amount;
    }

    /**
     * Set the value of quote_amount
     *
     * @return  self
     */ 
    public function setQuoteAmount($quote_amount)
    {   
        
        if ($this->base_amount_given) { 
            $this->returnError('base_amount given');
        }

        if ($this->type == null || $this->pair == null) { 
            $this->returnError('set type and pair firstly');
        }

        $this->quote_amount     = $quote_amount;

        $this->base_amount      = CurrencyConvert::convert($this->getPrice(),$quote_amount,$this->gettype());
        
        $this->quote_amount_given = true;

        return $this;
    }

    /**
     * Get the value of sold_amount
     */ 
    public function getSoldAmount()
    {
        return $this->sold_amount;
    }

    /**
     * Set the value of sold_amount
     *
     * @return  self
     */ 
    private function setSoldAmount()
    {   
        
        if ($this->type == 'SELL') {

            $this->sold_amount = $this->quote_amount;

        } else {

            $this->sold_amount = $this->base_amount;

        }

        return $this;
    }

    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set the value of total
     *
     * @return  self
     */ 
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }
}