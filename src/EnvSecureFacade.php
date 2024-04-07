<?php

namespace Izica\EnvSecure;

use Illuminate\Support\Facades\Facade;

class EnvSecureFacade extends Facade
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
