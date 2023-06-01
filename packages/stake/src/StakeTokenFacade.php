<?php

namespace Sayedsoft\StakeToken;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sayedsoft\StakeToken\Skeleton\SkeletonClass
 */
class StakeTokenFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'stake-token';
    }
}
