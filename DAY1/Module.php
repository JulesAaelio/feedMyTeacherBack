<?php
/**
 * Created by PhpStorm.
 * User: Jules LAURENT
 * Date: 26/09/2017
 * Time: 23:16
 */

class Module
{
    public function __construct($subject,$teacher)
    {
        $this->subject = $subject;
        $this->teacher = $teacher;
    }

    public function __toString()
    {
        return $this->subject.' '.$this->teacher;
    }

    private $subject;
    private $teacher;
}