<?php
namespace Sayedsoft\ExchangeToken\Exchange\Order;

use App\Models\User;
use Sayedsoft\ExchangeToken\Exchange\Helpers\FeeCalculator;
use Sayedsoft\ExchangeToken\Models\ExchangePairs;
use stdClass;

trait Fee 
{

    private $has_fee = false;

    private $fee_fase,$fee_fase_id;

    private $fee_setted = false;

    private $baseFee;

    private $quoteFee;


    private function setFee() {
        if ($this->pair_id == null) {
            return;
        }   

        if ($this->pair->fee_face_id != null) {

            $this->fee_fase = $this->pair->feeFace;

            $this->fee_fase_id = $this->pair->fee_face_id;

            $this->has_fee = true;

            $this->setBaseFee();

            $this->setQuoteFee();
        }

        $this->fee_setted = true;

        return $this;
    }

    


    /**
     * Get the value of baseFee
     */ 
    public function getBaseFee()
    {   
        return $this->baseFee;
    }

    /**
     * Set the value of baseFee
     *
     * @return  self
     */ 
    private function setBaseFee()
    {   
        if ($this->has_fee) {
            $calculator = new FeeCalculator();
            $calculator->setAmount($this->getBaseAmount());
            $calculator->setFixed_amount($this->fee_fase->quote_base_fixed_amount);
            $calculator->setPercentAmount($this->fee_fase->quote_base_percent_amount);
            $calculator->setType($this->fee_fase->quote_type);
            $calculator->calculate();
    
            $amounts                 = new stdClass();
            $amounts->amount        = $calculator->getAmount();
            $amounts->fee           = $calculator->getAmountFee();
            $amounts->withFee       = $calculator->getWithFee();
            $amounts->withOutFee    = $calculator->getWithoutFee();
            $this->baseFee = $amounts;
        } else {
            $amounts                = new stdClass();
            $amounts->amount        = $this->getBaseAmount();
            $amounts->fee           = 0;
            $amounts->withFee       = $this->getBaseAmount();
            $amounts->withOutFee    = $this->getBaseAmount();
        }

        return $this;
    }

    /**
     * Get the value of quoteFee
     */ 
    public function getQuoteFee()
    {
        return $this->quoteFee;
    }

    /**
     * Set the value of quoteFee
     *
     * @return  self
     */ 
    private function setQuoteFee()
    {   
        if ($this->has_fee) {
            $calculator = new FeeCalculator();
            $calculator->setAmount($this->getQuoteAmount());
            $calculator->setFixed_amount($this->fee_fase->quote_fixed_amount);
            $calculator->setPercentAmount($this->fee_fase->quote_percent_amount);
            $calculator->setType($this->fee_fase->quote_type);
            $calculator->calculate();
    
            $amounts                 = new stdClass();
            $amounts->amount        = $calculator->getAmount();
            $amounts->fee           = $calculator->getAmountFee();
            $amounts->withFee       = $calculator->getWithFee();
            $amounts->withOutFee    = $calculator->getWithoutFee();
            $this->quoteFee = $amounts;
        } else {
            $amounts                = new stdClass();
            $amounts->amount        = $this->getQuoteFee();
            $amounts->fee           = 0;
            $amounts->withFee       = $this->getQuoteFee();
            $amounts->withOutFee    = $this->getQuoteFee();
        }

        return $this;
    }
}