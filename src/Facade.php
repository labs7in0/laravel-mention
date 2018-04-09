<?php

namespace Labs7in0\Mention;

class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Labs7in0\\Mention\\Parser';
    }
}
