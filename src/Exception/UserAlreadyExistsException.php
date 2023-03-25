<?php

namespace App\Exception;

use Throwable;

class UserAlreadyExistsException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('user already exists');
    }
}