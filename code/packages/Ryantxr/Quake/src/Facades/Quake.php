<?php

namespace Ryantxr\Quake\Facades;

use Illuminate\Support\Facades\Facade;

class Quake extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'quake';
    }
}
