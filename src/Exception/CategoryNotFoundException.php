<?php

namespace App\Exception;

use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class CategoryNotFoundException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('category not found');
    }
}