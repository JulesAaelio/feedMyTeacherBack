<?php

namespace ReviewBundle\Entity;

class User
{
    private $last_name;
    private $first_name;

    public function __construct($first_name,$last_name)
    {
        $this->last_name = $last_name;
        $this->first_name = $first_name;
    }

    public function __toString()
    {
        return $this->last_name.' '.$this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }
}
