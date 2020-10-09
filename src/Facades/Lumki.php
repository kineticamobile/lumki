<?php

namespace Kineticamobile\Lumki\Facades;

use Illuminate\Support\Facades\Facade;

class Lumki extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'lumki';
    }
}
