<?php

namespace Harrysbaraini\JasonApi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Harrysbaraini\JasonApi\Skeleton\SkeletonClass
 */
class JasonApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'jason-api';
    }
}
