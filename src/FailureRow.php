<?php

namespace Aabadawy\RowCatcher;

class FailureRow
{
    protected string $exceptionMessage;

    protected int $exceptionCode;

    protected string $exceptionTraceAsString;
    
    public function __construct(protected \Throwable $exception,protected array $vars)
    {
        $this->setExceptionTraceAsString($this->exception->getTraceAsString());
        $this->setExceptionMessage($this->exception->getMessage());
        $this->setExceptionCode($this->exception->getCode());
    }

    /**
     * @param string $exceptionMessage
     */
    protected function setExceptionMessage(string $exceptionMessage): void
    {
        $this->exceptionMessage = $exceptionMessage;
    }

    /**
     * @param string $exceptionTraceAsString
     */
    protected function setExceptionTraceAsString(string $exceptionTraceAsString): void
    {
        $this->exceptionTraceAsString = $exceptionTraceAsString;
    }

    /**
     * @param int $exceptionCode
     */
    protected function setExceptionCode(int $exceptionCode): void
    {
        $this->exceptionCode = $exceptionCode;
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
        return $this->exceptionMessage;
    }

    /**
     * @return array
     */
    public function getVars(): array
    {
        return $this->vars;
    }
}