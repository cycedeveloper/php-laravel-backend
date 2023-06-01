<?php
namespace Sayedsoft\ExchangeToken\Exchange\Order;

use App\Models\User;
use Sayedsoft\ExchangeToken\Models\ExchangePairs;

trait Details 
{

    public $user_id,$pair_id;

    public $user, $pair, $price;

    public $type;

    public $base_asset, $quote_asset;

    public $sold_token,$buyed_token;

     /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user_id)
    {
        $this->user    = User::find($user_id);
        if (empty($this->user)) {
            return $this->returnError('User not found');
        } 

        $this->user_id = $this->user_id;

        return $this;
    }

    /**
     * Get the value of pair
     */ 
    public function getPair()
    {   
        
        return $this->pair;
    }

    /**
     * Set the value of pair
     *
     * @return  self
     */ 
    public function setPair($pair_id)
    {
        
        $this->pair = ExchangePairs::find($pair_id);
        if (empty($this->pair)) {
            return $this->returnError('pair not found');
        }

        $this->pair_id = $pair_id;

        $this->price      = $this->pair->price;

        $this->base_asset = $this->pair->baseAsset;

        $this->quote_asset = $this->pair->quoteAsset;

        $this->setSoldBuyedTokens();

        return $this;
    }


      /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return (float)$this->price;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
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
        if ($type == 'SELL' || $type == 'BUY') {

            $this->type = $type;
            
            return $this;
        }

        return $this->returnError('type invalid');

        
    }
    

    /**
     * Set the value of selected_asset
     *
     * @return  self
     */ 
    private function setSoldBuyedTokens()
    {
        if ($this->type == 'SELL') {

            $this->sold_token = $this->quote_asset;

            $this->buyed_token = $this->base_asset;

        } else {

            $this->sold_token = $this->base_asset;

            $this->buyed_token = $this->quote_asset;

        }

        return $this;
    }


}