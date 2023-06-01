<?php
namespace Sayedsoft\ExchangeToken\Exchange\Helpers;


use Exception;
use Sayedsoft\Dex\Base\Helpers\NF;
use Sayedsoft\Dex\Fees\Models\FeeFace;
use Sayedsoft\ExchangeToken\Models\ExchangeFeeFace;
use stdClass;

class FeeCalculator  {

    private $fixed_amount,$percent_amount,$type;

    private $amount;

    private $types = ['none','fixed','percent'];

    private $amountFee = 0;

    private $withFee,$withoutFee;
    
    public function __construct()
    {
        
    }

    public  function calculate() {
        $this->validate();
 
        switch ($this->type) {
         case 'none':
             break;
 
         case 'fixed':
             $this->fixedFee();
             break;
 
         case 'percent':
             $this->percentFee();
             break;
         
         default:
             # code...
             break;
        }
 
 
        return $this;
     }



    private function validate() {

        if (!is_numeric($this->getAmount()) || $this->getAmount() <= 0) $this->returnError('Amount invalid');

        if (!in_array($this->getType(),$this->types)) $this->returnError('Type invalid');

    }

    

     private function fixedFee() {

        return $this->setAmountFee($this->fixed_amount);
     }

     private function percentFee() {

        $fee = ($this->getAmount() * $this->percent_amount) / 100;

        return $this->setAmountFee($fee);
     }

    
    public function setFixed_amount($fixed_amount)
    {
        $this->fixed_amount = $fixed_amount;

        return $this;
    }

    public function setPercentAmount($percent_amount)
    {
        $this->percent_amount = $percent_amount;

        return $this;
    }


    public function getAmount()
    {   
        return $this->amount;
    }

    /**
     * Get the value of type
     */ 
    private function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {   


        $this->type = $type;

        return $this;
    }


    /**
     * Set the value of amount
     *
     * @return  self
     */ 
    public function setAmount($amount)
    {
        $this->amount = $amount;

        $this->total  = $amount;

        return $this;
    }

    /**
     * Get the value of amountFee
     */ 
    public function getAmountFee()
    {
        return $this->amountFee;
    }

    private function setAmountFee($amountFee)
    {
        $this->amountFee = $amountFee;

        return $this;
    }

    private function returnError($message)
    {   

         throw(new Exception($message));;
    }


    /**
     * Get the value of withFee
     */ 
    public function getWithFee()
    {
        return NF::set($this->getAmount() + $this->getAmountFee()) ;
    }

    /**
     * Get the value of withoutFee
     */ 
    public function getWithoutFee()
    {
        return  NF::set($this->getAmount() - $this->getAmountFee()) ;
    }

    /**
     * Get the value of settings
     */ 
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * Set the value of settings
     *
     * @return  self
     */ 
    public function setSettings($fixed_amount,$percent_amount,$type)
    {   
        $this->fixed_amount = $fixed_amount;

        $this->percent_amount = $percent_amount;

        $this->type = $type;

        return $this;
    }
}