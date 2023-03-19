<?php

namespace App\Model;

class ErrorValidationDetailsItem
{
    public function __construct(
        private string $field,
        private string $message
    ) { }    

    /**
     * @return string
     */ 
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return string
     */ 
    public function getMessage()
    {
        return $this->message;
    }
}