<?php

namespace Gamer\Facades;

use Illuminate\Support\Facades\Facade;

class Gamer extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'gamer';
    }
}
