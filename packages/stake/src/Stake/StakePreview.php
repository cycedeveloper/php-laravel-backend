<?php
namespace Sayedsoft\StakeToken\Stake;

use Illuminate\Support\Facades\DB;
use stdClass;

trait StakePreview {

    public function preview() {


        if (!$this->inited || !$this->validated ) {
            return $this->returnError('Stake not inited or validated');
        }

        try {

            $details = $this->getDetails();

            $stake = new stdClass();
            
            $stake->user_id = $this->getUser()->id;

            $stake->stake_plan_id = $this->getPlan()->id;

            $stake->amount = $this->getAmount();

            $stake->end_date = $details->endDate;


            $stake->token_id   = $this->getToken()->id;

            $stake->period_type = $this->getPlan()->period_type;

            $stake->period_interval = $this->getPlan()->period_interval;
            
            $stake->total_profits = $details->totalPeriodsProfit;

            $stake->profit_period_type = $this->getPlan()->profit_period_type;

            $stake->profit_period_count = $details->profitsPeriodsCount;

            $stake->profit_period_amount = $details->perPeriodProfit;

            $stake->percentile_profit = $this->getPlan()->percentile_profit;
            
            $stake->deserved_profit_period = 0;

            $stake->deserved_profit = 0;


            return $stake;

       } catch (\Throwable $th) {
          
            throw($th);
       }

    }
    


}