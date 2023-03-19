<?php

namespace App\Model;

class ErrorResponse
{
    public function __construct(
        private string $message,
        private int $code
    ) { }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param int
     */
    public function getCode()
    {
        return $this->code;
    }
}