<?php

namespace App\Model;

class ErrorDebugDetails
{
    public function __construct(
        private string $trace
    ) { }

    public function getTrace()
    {
        return $this->trace;
    }
}
