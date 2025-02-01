<?php

namespace Ilm\Ecom\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ilm\Ecom\Air
 */
class IlmComm extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Ilm\Ecom\Air::class;
    }
}
