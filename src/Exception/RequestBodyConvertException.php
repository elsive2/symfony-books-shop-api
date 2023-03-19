<?php

namespace App\Exception;

use Throwable;

class RequestBodyConvertException extends \RuntimeException
{
    public function __construct(Throwable $previous)
    {
        parent::__construct('error while unmarshaling request body', 0, $previous);
    }
}