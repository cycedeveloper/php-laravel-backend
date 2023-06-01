<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Sayedsoft\Dex\Accounting\Models\AccountingTotal;
use Sayedsoft\Dex\Token\Models\Token;

class Staked extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {   $tokens = Token::pluck('token_name','id');
        return $this->sum($request, AccountingTotal::where('total_for','STAKED'), 'amount', 'token_id')
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
        return 'staked';
    }
}
