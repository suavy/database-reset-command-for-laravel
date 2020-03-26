<?php

namespace Suavy\DatabaseResetCommandForLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Suavy\DatabaseResetCommandForLaravel\Skeleton\SkeletonClass
 */
class DatabaseResetCommandForLaravelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'database-reset-command-for-laravel';
    }
}
