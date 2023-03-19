<?php

namespace App\Request;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;

class SubscriberRequest
{
    #[Email]
    #[NotBlank]
    private string $email;
    
    #[NotBlank]
    #[IsTrue]
    private bool $agreed;

    /**
     * Get the value of email
     * @return string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param string $email
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of agreed
     * @return bool
     */ 
    public function getAgreed()
    {
        return $this->agreed;
    }

    /**
     * Set the value of agreed
     *
     * @param bool $agreed
     * @return  self
     */ 
    public function setAgreed($agreed)
    {
        $this->agreed = $agreed;

        return $this;
    }
}