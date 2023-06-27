<?php

namespace Sayedsoft\DexwithdrawalFiat;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sayedsoft\DexwithdrawalFiat\Skeleton\SkeletonClass
 */
class DexwithdrawalFiatFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dex-withdrawalFiat';
    }
}
