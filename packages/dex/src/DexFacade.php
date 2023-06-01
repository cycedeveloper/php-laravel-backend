<?php

namespace Sayedsoft\Dex;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sayedsoft\Dex\Skeleton\SkeletonClass
 */
class DexFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dex';
    }
}
