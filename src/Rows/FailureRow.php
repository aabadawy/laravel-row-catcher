<?php

namespace Aabadawy\RowCatcher\Rows;

class FailureRow implements Rowable
{
    public function __construct(protected \Throwable $exception,protected mixed $row)
    {

    }

    /**
     * @return \Throwable
     */
    public function getException(): \Throwable
    {
        return $this->exception;
    }

    /**
     * @return string
     */
    public function getExceptionMessage(): string
    {
        return $this->exception->getMessage();
    }

    public function getExceptionCode():int
    {
        return $this->exception->getCode();
    }

    /**
     * determine current exception instance of passed Throwable
     * @param \Throwable $instance
     * @return bool
     */
    public function exceptionIs(\Throwable $instance):bool
    {
        return $this->exception instanceof $instance;
    }

    /**
     * @return array
     */
    public function getRow(): array
    {
        return $this->row;
    }

    public function type(): RowType
    {
        return RowType::Failure;
    }
}