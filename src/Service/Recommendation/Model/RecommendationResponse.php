<?php

namespace App\Service\Recommendation\Model;

class RecommendationResponse
{
    public function __construct(
        private int $id,
        private int $ts,
        private array $recommendations
    ) { }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of ts
     */ 
    public function getTs()
    {
        return $this->ts;
    }

    /**
     * Set the value of ts
     *
     * @return  self
     */ 
    public function setTs($ts)
    {
        $this->ts = $ts;

        return $this;
    }

    /**
     * @return RecommendationItem[]
     */ 
    public function getRecommendations()
    {
        return $this->recommendations;
    }

    /**
     * Set the value of recommendations
     *
     * @return  self
     */ 
    public function setRecommendations($recommendations)
    {
        $this->recommendations = $recommendations;

        return $this;
    }
}