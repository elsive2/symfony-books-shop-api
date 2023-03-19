<?php

namespace App\Model;

class ErrorResponse
{
    public function __construct(
        private string $message,
        private int $code,
        private mixed $details = null
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

    /**
     * @param mixed
     */
    public function getDetails()
    {
        return $this->details;
    }
}