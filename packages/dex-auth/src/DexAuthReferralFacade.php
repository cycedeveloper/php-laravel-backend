<?php

namespace Sayedsoft\DexAuthReferral;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sayedsoft\DexAuthReferral\Skeleton\SkeletonClass
 */
class DexAuthReferralFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dex-auth-referral';
    }
}
