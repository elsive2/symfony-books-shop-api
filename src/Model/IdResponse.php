<?php

namespace App\Model;

class IdResponse
{
    public function __construct(
        private int $id
    ) { }



    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
}