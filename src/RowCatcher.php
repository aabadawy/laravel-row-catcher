<?php

namespace Aabadawy\RowCatcher;

use \Aabadawy\RowCatcher\Contract\RowCatcher as RowCatcherContract;
use Illuminate\Support\Collection;

class RowCatcher implements RowCatcherContract
{
    protected Collection $failures;

    protected Collection $successes;

    public function startCatching():void
    {
        $this->init();
    }

    public function endCatching():void
    {
        $this->init();
    }

    public function getFailures():Collection
    {
        return $this->failures;
    }

    public function getSuccesses():Collection
    {
        return $this->successes;
    }
    
    public function catchFailure(\Throwable $throwable,$row = null): void
    {
        $this->failures->add(new FailureRow($throwable,$row));
    }

    public function catchSuccess($row = null):void
    {
        $this->successes->add(new SuccessRow($row));
    }

    public function countFailures():int
    {
        return $this->failures->count();
    }

    public function countSuccesses():int
    {
        return $this->successes->count();
    }

    private function init()
    {
        $this->initEmptyFailures();
        $this->initEmptySuccesses();
    }

    private function initEmptyFailures()
    {
        $this->failures     = new Collection();
    }

    private function initEmptySuccesses()
    {
        $this->successes    = new Collection();
    }

    //TODO fire event after passed number of failures and passed number of successes if needed
}