<?php

namespace Sayedsoft\StakeToken\Career\Traits;

use Sayedsoft\StakeToken\Models\Career\UserCareerProfits;

trait CareerProfitsTrait
{
    private function addCareerProfit($career_id, $amount, $amountTerm)
    {
        return  UserCareerProfits::updateOrCreate([
           'career_id' => $career_id,
           'user_id' => $this->getUserId(),

        ], [
           'amount' => $amount,
           'staked' => $amountTerm,
        ]);
    }

     private function _hasCreerProfit($career_id)
     {
         $exists =  UserCareerProfits::where('career_id', $career_id)->where('user_id', $this->getUserId())->first();
         if (!$exists) {
             return false;
         }
         return true;
     }

     private function getCreerProfits()
     {
         return UserCareerProfits::where('user_id', $this->getUserId())->sum('staked');
     }
}
