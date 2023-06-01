<?php

namespace Sayedsoft\StakeToken\Career;

use Illuminate\Support\Facades\DB;

use Sayedsoft\ReferralUnilevel\Traits\Referral\UserSetter;
use Sayedsoft\StakeToken\Career\Traits\CareerGettersTrait;
use Sayedsoft\StakeToken\Career\Traits\CareerMathTrait;
use Sayedsoft\StakeToken\Career\Traits\CareerProfitsTrait;
use Sayedsoft\StakeToken\Career\Traits\CareerTemperTrait;
use Sayedsoft\StakeToken\Career\Traits\EX;
use stdClass;

class UserCareer
{
    use UserSetter;

    use CareerProfitsTrait;

    use CareerGettersTrait;

    use CareerMathTrait;

    use CareerTemperTrait;

    public $totalAdded   = 0;

    public $lastAdded    = 0;

    public $lastRemain   = 0;

    public $term;

    public $careersData;

    public $selectedCareer;

    public $remain;

    public function __construct($user)
    {
        $this->setUser($user);
    }


    private function init()
    {
        $this->checkUser();

        $this->_getCareers();

        $this->_getAnalyze();

        $this->careersData = new stdClass();

        $this->lastRemain = $this->_teamStaked;
    }

    private function _createCareerObject($career, $index, $term)
    {
        $amountTerm = (float) $term['value_num_1'];

        $this->lastAdded     += $amountTerm;

        $data = new stdClass();
        $data->career         = $career;
        $data->careerIndex    = $index;
        $data->amountTerm     = $amountTerm;
        $data->trueAmountTerm = $this->lastAdded;
        $data->profit         = (float) $term['value_num_2'];
        $data->status         = 'wait';
        $data->lastRemain     = $this->lastRemain;
        $data->expiredAmount  = $this->lastRemain;
        $data->percentile     = 100;
        $data->selected       = false;

        return $data;
    }


    private function _careerWWithConverters($data)
    {
        $data->amountTerm      = EX::nu($data->amountTerm, 2, 'base');
        $data->trueAmountTerm  = EX::nu($data->trueAmountTerm, 2, 'base');
        $data->expiredAmount   = EX::nu($data->expiredAmount, 2, 'base');

        return $data;
    }

    private function _checkCareerTerm($career, $index, $term)
    {
        $data = $this->_createCareerObject($career, $index, $term);

        if ($this->lastRemain >= $data->trueAmountTerm) {
            $this->lastRemain = $this->lastRemain - $data->amountTerm;
            $data->status = 'done';
            $data->expiredAmount = 0;
            $data->lastRemain = $this->lastRemain;

            $this->addCareerProfit($career->id, $data->profit, $data->amountTerm);
        } else {
            if (!$this->selectedCareer) {
                $this->selectedCareer = $career->id;
                $data->selected       = true;
            }
            $expiredAmount = $this->lastAdded -  $this->lastRemain;
            $data->expiredAmount = $expiredAmount;
            $data->percentile -= $this->percentile($data->trueAmountTerm, $expiredAmount);
        }



        $this->careersData->{$index} = $this->_careerWWithConverters($data) ;
    }

     private function _checkCareer($career, $index)
     {
         $careerTerms     =  $career->terms;
         if (!count($career->terms)) {
             return;
         }

         $term            = $careerTerms[0];

         return $this->_checkCareerTerm($career, $index, $term);

         return [];
     }

     private function _checkAllCareers()
     {
         $careers = $this->careers;
         foreach ($careers as $index => $career) {
             $this->_checkCareer((object) $career, $index);
         }
     }



     public function _rebuild()
     {
         $this->init();

         try {
             DB::beginTransaction();

             $this->_checkAllCareers();

             $result = new stdClass();

             $result->teamStaked     = $this->teamStaked;

             $result->careersData   = $this->careersData;

             $result->selectedCareer  = $this->selectedCareer;

             $result->lastRemain  = $this->lastRemain;

             $result->totalProfits  = $this->totalProfits;


             DB::commit();

             $this->isSetted = true;
         } catch (\Throwable $th) {
             DB::rollBack();
             throw $th;
         }


         return $result;
     }
}
