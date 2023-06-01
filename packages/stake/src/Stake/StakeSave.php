<?php
namespace Sayedsoft\StakeToken\Stake;

use Illuminate\Support\Facades\DB;
use Sayedsoft\StakeToken\Models\Stake;
use Sayedsoft\StakeToken\Models\StakeDetails;

trait StakeSave {

    private function saveDB() {

        if (!$this->inited || !$this->validated ) {
            return $this->returnError('Stake not inited or validated');
        }

        try {
            DB::beginTransaction();

            $details = $this->getDetails();

            $stake = new Stake();
            
            $stake->user_id = $this->getUser()->id;

            $stake->stake_plan_id = $this->getPlan()->id;

            $stake->amount = $this->getAmount();

            $stake->end_date = $details->endDate;

            $stake->save();
        
            $stakeDetails = new StakeDetails();

            $stakeDetails->stake_id = $stake->id;

            $stakeDetails->token_id   = $this->getToken()->id;

            $stakeDetails->period_type = $this->getPlan()->period_type;

            $stakeDetails->period_interval = $this->getPlan()->period_interval;
            
            $stakeDetails->total_profits = $details->totalPeriodsProfit;

            $stakeDetails->profit_period_type = $this->getPlan()->profit_period_type;

            $stakeDetails->profit_period_count = $details->profitsPeriodsCount;

            $stakeDetails->profit_period_amount = $details->perPeriodProfit;

            $stakeDetails->percentile_profit = $this->getPlan()->percentile_profit;
            
            $stakeDetails->deserved_profit_period = 0;

            $stakeDetails->deserved_profit = 0;

            $stakeDetails->save();

            DB::commit();

            return $stake;

       } catch (\Throwable $th) {
            DB::rollBack();
            throw($th);
       }

    }
    


}