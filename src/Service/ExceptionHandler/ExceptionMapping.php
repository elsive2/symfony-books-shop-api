<?php

namespace App\Service\ExceptionHandler;

class ExceptionMapping
{
    public function __construct(
        private int $code,
        private bool $hidden,
        private bool $loggable
    ) { }

    public static function fromCode(int $code): self
    {
        return new self($code, false, false);
    }

    /**
     * Get the value of code
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get the value of hidden
     * @return bool
     */
    public function isHidden()
    {
        return $this->hidden;
    }

    /**
     * Get the value of loggable
     * @return bool
     */
    public function isLoggable()
    {
        return $this->loggable;
    }
}