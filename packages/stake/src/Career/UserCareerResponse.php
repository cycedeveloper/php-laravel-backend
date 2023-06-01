<?php

namespace Sayedsoft\StakeToken\Career;

use App\Models\User;
use Sayedsoft\ExchangeToken\Exchange\Helpers\CurrencyConvert;
use Sayedsoft\ReferralIncome\Models\ReferralIncomeModel;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelUserReferral;
use Sayedsoft\ReferralUnilevel\Traits\Referral\UserSetter;
use Sayedsoft\StakeToken\Career\UserCareer;
use Sayedsoft\StakeToken\Models\Career\UserReferralCareerTemps;

class UserCareerResponse
{
    use UserSetter;

    private function _build($user)
    {
        $unilevel = new  UnilevelUserReferral($user);
        $childs   =  $unilevel->childsTree->rebuild()->set()->withCustomUserData(function ($user) {
            $_user = (object) User::find($user->user)->toArray();
            if ($_user) {
                return $_user;
            }
            return false ;
        }) ->getOnceLevel();

        $_career = new UserCareer($user);
        $career  = $_career->get() ;

        $incomes = ReferralIncomeModel::where('user_id', $user)->with('fromUser')->limit(10)->get();


        $data = [
            'childs' => $childs,
            //'analyze' => $analyze,
            'incomes' => $incomes,
            'career' => $career,
        ];

        return (object) $data;
    }

     public function rebuild($user)
     {
         $data = $this->_build($user);
         UserReferralCareerTemps::updateOrCreate([
              'user_id' => $user,
         ], [
             'user_id' => $user,
             'temp' => $data,
         ]);
         return $data;
     }

     public function get($user)
     {
         $hasTemp = UserReferralCareerTemps::where('user_id', $user)->first();
         if ($hasTemp) {
             return $hasTemp->temp;
         }

         $data = $this->_build($user);

         UserReferralCareerTemps::updateOrCreate([
              'user_id' => $user,
         ], [
             'user_id' => $user,
             'temp' => $data,
         ]);


         return $data;
     }
}
