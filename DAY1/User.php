<?php
class User
{
    public function __toString()
    {
        return $this->last_name.' '.$this->first_name;
    }

    public function __construct($first_name,$last_name)
    {
        $this->last_name = $last_name;
        $this->first_name = $first_name;
    }

    private $last_name;
	private $first_name;
}
