<?php

namespace Sayedsoft\DexWithdrawal;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sayedsoft\DexWithdrawal\Skeleton\SkeletonClass
 */
class DexWithdrawalFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dex-withdrawal';
    }
}
