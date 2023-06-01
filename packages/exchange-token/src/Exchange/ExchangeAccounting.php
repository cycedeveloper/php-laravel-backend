<?php

namespace Sayedsoft\ExchangeToken\Exchange;

use Sayedsoft\Dex\Accounting\Accounting;
use Sayedsoft\ExchangeToken\Models\ExchangeOrders;
use Sayedsoft\ExchangeToken\Models\ExchangePairs;

class ExchangeAccounting {

   // use AccountingTraid;

     private $user_id , $pair;
     
     public function __construct()
     {
       
     }

     private function calculateBase($type) {
       $total = ExchangeOrders::where('pair_id',$this->pair->id)
         ->where('user_id',$this->user_id)
         ->where('type',$type)
         ->selectRaw('user_id,pair_id,base_amount,base_fee_amount , sum(base_amount + base_fee_amount) as total')->first();
         if (!isset($total->total)) { return 0; }
         return $total->total;
    }

     private function calculateQuoe($type) {
      $total = ExchangeOrders::where('pair_id',$this->pair->id)
        ->where('user_id',$this->user_id)
        ->where('type',$type)
        ->selectRaw('user_id,pair_id,quote_amount,quote_fee_amount  , sum(quote_amount + quote_fee_amount) as total')->first();
        if (!isset($total->total)) { return 0; }
        return $total->total;
      }
   
     function refreshTotal () {

         Accounting::of('EXCHANGE_OUT',$this->pair->base_asset,$this->user_id)->set($this->calculateBase('BUY'));

         Accounting::of('EXCHANGE_IN',$this->pair->base_asset,$this->user_id)->set($this->calculateBase('SELL'));

         Accounting::of('EXCHANGE_OUT',$this->pair->quote_asset,$this->user_id)->set($this->calculateQuoe('SELL'));

         Accounting::of('EXCHANGE_IN',$this->pair->quote_asset,$this->user_id)->set($this->calculateQuoe('BUY'));
    }

    public function refreshTotals()
    {   
        $pairs = ExchangePairs::all();
        foreach ($pairs as $pair) {
          $this->setPair($pair);
          $this->refreshTotal();
        }
        
    }
     


     /**
      * Set the value of user_id
      *
      * @return  self
      */ 
     public function setUser_id($user_id)
     {
          $this->user_id = $user_id;

          return $this;
     }

     /**
      * Set the value of token_id
      *
      * @return  self
      */ 
     public function setToken_id($token_id)
     {
          $this->token_id = $token_id;

          return $this;
     }

     /**
      * Set the value of pair
      *
      * @return  self
      */ 
     public function setPair($pair)
     {
          $this->pair = $pair;

          $this->setBase($this->pair->base_asset);

          $this->setQuote($this->pair->quote_asset);

          return $this;
     }

     /**
      * Set the value of base
      *
      * @return  self
      */ 
     public function setBase($base)
     {
          $this->base = $base;

          return $this;
     }

     /**
      * Set the value of quote
      *
      * @return  self
      */ 
     public function setQuote($quote)
     {
          $this->quote = $quote;

          return $this;
     }
}