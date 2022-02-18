<?php
namespace Aabadawy\RowCatcher\Contract;

use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;

interface RowCatcher
{
    public function startCatching(array|\Countable $rows):self;

    public function endCatching():void;

    public function catchFailure(\Throwable $throwable,$row = null):void;

    public function catchSuccess($row = null):void;

    public function getFailures():Collection;

    public function getSuccesses():Collection;

    public function numberOfFailures():int;

    public function numberOfSuccesses():int;

    public function allSuccess():bool;

    public function allFailed():bool;

    public function each(callable $callable);
    /*
     * on(10,INROW)
     * ->event(new FailureEvent1())
     * ->event(new FailureEvent2())
     */

}
