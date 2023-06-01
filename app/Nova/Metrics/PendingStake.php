<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Sayedsoft\Dex\Token\Models\Token;
use Sayedsoft\StakeToken\Models\Stake;

class PendingStake extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {   $tokens = Token::pluck('token_name','id');
        return $this->count($request, 
        Stake::leftJoin('dex_stakes_plans', function($join) {
            $join->on('dex_stakes.stake_plan_id', '=', 'dex_stakes_plans.id');
          })->leftJoin('dex_tokens', function($join) {
            $join->on('dex_stakes_plans.token_id', '=', 'dex_tokens.id');
          })->where('dex_stakes.status','pending')
          
          , 'stake_plan_id')
          ->label(function($token_id) use ($tokens) 
            {
                    return isset($tokens[$token_id]) ? $tokens[$token_id] : 'Unknown';
                                
            });
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'pending-stake';
    }
}
