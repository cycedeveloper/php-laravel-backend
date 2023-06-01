<?php

namespace Sayedsoft\StakeToken\Career\Traits;

use Sayedsoft\ExchangeToken\Exchange\Helpers\CurrencyConvert;
use Sayedsoft\ReferralUnilevel\Unilevel;
use Sayedsoft\StakeToken\Models\Career\Career;
use Sayedsoft\StakeToken\Models\Career\CareerTermsDetails;
use stdClass;

trait CareerGettersTrait
{
    private $teamStaked;

    private $_teamStaked = 0;

    private $totalProfits;

    private $careers;

    private function _getCareers()
    {
        $this->careers = (object) Career::with('terms')->get()->toArray();
        return $this->careers;
    }

    private function _getCareerTerms($career_id)
    {
        return CareerTermsDetails::where('career_id', $career_id)->get();
    }

    private function _getAnalyze()
    {
        $unilevel  =  Unilevel::Analyzers($this->getUser());
        $details   = $unilevel->result();


        if (empty($details)) {
            $unilevel->rebuild();
            $details   = $unilevel->result();
        }

        $staked  = 0;

        foreach ($details as $detail) {
            if ($detail->name == 'staked') {
                $values = $detail->values;

                foreach ($values as $key => $value) {
                    $staked += $value;
                }
            }
        }

        $this->teamStaked = EX::nu($staked, 2, 'qoute', 1);

        $this->_teamStaked = $this->teamStaked->baseAmount;

        $this->totalProfits   = EX::nu($this->getCreerProfits(), 2, 'base')  ;
    }
}
