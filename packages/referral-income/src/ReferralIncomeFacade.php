<?php

namespace Sayedsoft\ReferralIncome;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sayedsoft\ReferralIncome\Skeleton\SkeletonClass
 */
class ReferralIncomeFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'referral-income';
    }
}
