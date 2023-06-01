<?php

namespace Sayedsoft\StakeToken\Career\Traits;

use Sayedsoft\StakeToken\Models\Career\UserCareerTemps;

trait CareerTemperTrait
{
    private function updateCareerDetailsTemp($detail)
    {
        return  UserCareerTemps::updateOrCreate([
              'user_id' => $this->getUserId(),

           ], [
              'user_id' => $this->getUserId(),
              'temp' => json_encode((array) $detail),
           ]);
    }


     private function _getCreerTemp()
     {
         return UserCareerTemps::where('user_id', $this->getUserId())->first();
     }


    public function getTemp()
    {
        $hasTemp = $this->_getCreerTemp();
        if ($hasTemp) {
            return json_decode($hasTemp->temp);
        }

        return false;
    }

     public function get($forceRebuild = false)
     {
         $temp = $this->getTemp();


         if ($temp && !$forceRebuild) {
             return $temp;
         }

         $restult =  $this->_rebuild();

         $this->updateCareerDetailsTemp($restult);

         return $restult;
     }
}
