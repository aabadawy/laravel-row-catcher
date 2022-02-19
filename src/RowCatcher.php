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

    /**
     * init start catching
     * @param array|\Countable $rows
     * @return $this
     */
    public function startCatching(array|\Countable $rows):self
    {
        $this->rows = $rows;

        $this->totalRows = count($rows);

        $this->init();

        return $this;
    }

    /**
     * loop through rows with passed callable
     * @param callable $callable
     * @return void
     */
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

    /**
     * clear the catching
     * @return void
     */
    public function endCatching():void
    {
        $this->init();
    }

    /**
     * get all failure rows
     * @return Collection
     */
    public function getFailures():Collection
    {
        return $this->failures;
    }

    /**
     * get all success rows
     * @return Collection
     */
    public function getSuccesses():Collection
    {
        return $this->successes;
    }

    /**
     * catch failure row and the exception
     * @param \Throwable $throwable
     * @param $row
     * @return void
     */
    public function catchFailure(\Throwable $throwable,$row = null): void
    {
        $failure_row = $this->failureRow($throwable,$row);
        $this->failures->add($failure_row);
    }

    /**
     * catch success row
     * @param $row
     * @return void
     */
    public function catchSuccess($row = null):void
    {
        $success_row = $this->successRow($row);
        $this->successes->add($success_row);
    }

    /**
     * get total number of failures
     * @return int
     */
    public function numberOfFailures():int
    {
        return $this->failures->count();
    }

    /**
     * get total number of successes
     * @return int
     */
    public function numberOfSuccesses():int
    {
        return $this->successes->count();
    }

    /**
     * determine all passed rows are successful or not
     * @return bool
     */
    public function allSuccess():bool
    {
        return $this->numberOfSuccesses() == $this->totalRows;
    }

    /**
     * determine all passed rows are failed or not
     * @return bool
     */
    public function allFailed(): bool
    {
        return $this->numberOfFailures() == $this->totalRows;
    }

    /**
     * init empty failures and successes collections
     * @return void
     */
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

    /**
     * @param \Throwable $throwable
     * @param $row
     * @return array
     */
    private function failureRow(\Throwable $throwable,$row = null)
    {
        return ['exception' => $throwable,'row' => $row];
    }

    private function successRow($row = null)
    {
        return ['row' => $row];
    }
    //TODO fire event after passed number of failures and passed number of successes if needed
}