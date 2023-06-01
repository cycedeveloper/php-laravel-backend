<?php

namespace Sayedsoft\ReferralTree;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sayedsoft\ReferralTree\Skeleton\SkeletonClass
 */
class ReferralTreeFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'referral-tree';
    }
}
