<?php
namespace Aabadawy\RowCatcher\Contract;

use Illuminate\Support\Collection;

interface RowCatcher
{
    public function startCatching():void;

    public function endCatching():void;

    public function catchFailure(\Throwable $exception,mixed $row):void;

    public function catchSuccess(mixed $row):void;

    public function getFailures():Collection;

    public function getSuccesses():Collection;

    public function countFailures():int;

    public function countSuccesses():int;
}