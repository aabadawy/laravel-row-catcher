<?php

namespace Aabadawy\RowCatcher;

use Aabadawy\RowCatcher\Contract\RowCatcher as RowCatcherContract;
use Aabadawy\RowCatcher\Rows\FailureRow;
use Aabadawy\RowCatcher\Rows\SuccessRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Enumerable;

class RowCatcher implements RowCatcherContract
{
    protected Collection $failures;

    protected Collection $successes;

    protected  int $totalRows;

    protected array|\Countable $rows;

    public function startCatching(array|\Countable $rows):self
    {
        $this->rows = $rows;

        $this->totalRows = (is_countable($rows)) ? count($rows) : $rows;

        $this->init();

        return $this;
    }

    public function each(callable $callable):void
    {
        foreach ($this->rows as $row) {
            try {
                $callable($row);
                $this->catchSuccess($row);
            } catch (\Throwable $exception) {
                $this->catchFailure($exception,$row);
            }
        }
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

    public function numberOfFailures():int
    {
        return $this->failures->count();
    }

    public function numberOfSuccesses():int
    {
        return $this->successes->count();
    }

    public function allSuccess():bool
    {
        return $this->numberOfSuccesses() == $this->totalRows;
    }

    public function allFailed(): bool
    {
        return $this->numberOfFailures() == $this->totalRows;
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