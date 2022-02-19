<?php

namespace Aabadawy\RowCatcher\Facade;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use \Aabadawy\RowCatcher\Contract\RowCatcher as RowCatcherContract;

/**
 * @method static RowCatcherContract startCatching(array|\Countable $rows)
 * @method static void each(callable $callable)
 * @method static bool allSuccess()
 * @method static bool allFailed()
 * @method static array|\Countable getRegisteredRows()
 * @method static Collection getFailures()
 * @method static Collection getSuccesses()
 * @method static void catchSuccess()
 * @method static void catchFailure()
 */
class RowCatcher extends Facade
{

    protected static function getFacadeAccessor()
    {
        return RowCatcherContract::class;
    }
}