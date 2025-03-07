<?php

namespace Kobalt\LaravelProductiveio\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Kobalt\LaravelProductiveio\LaravelProductiveio
 */
class Productive extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Kobalt\LaravelProductiveio\LaravelProductiveio::class;
    }
}
