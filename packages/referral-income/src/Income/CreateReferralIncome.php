<?php

namespace Sayedsoft\ReferralIncome\Income;

use App\Models\User;
use Sayedsoft\ReferralIncome\Income\Details;
use Sayedsoft\ReferralIncome\Models\ReferralIncomeModel;
use Sayedsoft\ReferralUnilevel\Core\UserReferral\UnilevelUserReferral;
use Sayedsoft\ReferralUnilevel\Models\Referral\Referral;
use stdClass;

class CreateReferralIncome
{
    use Details;


    private function levelAmount($percentile)
    {
        return  ($this->getAmount() * $percentile) / 100;
    }


    public function getLevel($level)
    {
        $get = nova_get_setting('ref_'.$level);
        if (isset($get) && is_numeric($get) && $get > 0) {
            return $get;
        }
        return false;
    }


    public function checkCanTake($sponsor, $user)
    {
        $unilevel =  new  UnilevelUserReferral($sponsor);
        $childs   =  $unilevel->childsTree->rebuild()->set()->limitLevelsUsers()->get();

        $canTake = false;

        foreach ($childs as $child) {
            if ($child->user == $user) {
                $canTake = true;
            }
        }

        return $canTake;
    }

    public function save()
    {
        $this->sponsors     = $this->getUser()->referral->sponsors;

        foreach ($this->sponsors as $level => $sponsor) {
            $level_per  = $this->getLevel($level);
            if (!$level_per) {
                continue;
            }


            $amontLevel = $this->levelAmount($level_per);

            $canTake = $this->checkCanTake($sponsor->user_id, $this->getUser()->id);
            $f = ($canTake) ? " Can Take " : " Cannt take " ;
            echo   $f." ".$sponsor->user_id." from ". $this->getUser()->id. " ////  ";
            if (!$canTake) {
                continue;
            }

            $row             = new stdClass();
            $row->user_id    = $sponsor->user_id;
            $row->uchild_id   = $this->getUser()->id;
            $row->token_id   = $this->token_id;
            $row->type_ref   = $this->type;
            $row->related_id = $this->related_id;
            $row->percent    = $level_per;
            $row->level      = $level;
            $row->amount     = $amontLevel;
            $row->org_amount = $this->getAmount();
            if ($row->amount > 0 && $amontLevel > 0) {
                /*
                ReferralIncomeModel::updateOrCreate([
                    'user_id'  => $sponsor->user_id,
                    'uchild_id' => $row->uchild_id,
                    'token_id' => $this->token_id,
                    'type_ref' => $row->type_ref,
                    'related_id' => $row->related_id,
                ],(array)$row);
                */
            }
        }
    }
}
