<?php

namespace App\Model;

class Rating
{
    public function __construct(
        private int $total,
        private float $rating
    ) { }

    

    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }
}