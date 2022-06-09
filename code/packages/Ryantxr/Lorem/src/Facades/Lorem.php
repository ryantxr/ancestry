<?php

namespace Ryantxr\Lorem\Facades;

use Illuminate\Support\Facades\Facade;

class Lorem extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'lorem';
    }
}
