<?php

namespace App\Exception;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class SubscriberAlreadyExists extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('subscriber already exists');
    }
}