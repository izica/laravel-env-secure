<?php

namespace Izica\EnvSecure;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Izica\LaravelEnvSecure\Skeleton\SkeletonClass
 */
class LaravelEnvSecureFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-env-secure';
    }
}
