<?php

class Review
{
	private $teacherRate;
	private $teacherReview;
	private $classRate;
	private $classReview;
	private $sender;
	public function __construct($teacherRate,$teacherReview,$classRate,$classReview,$sender)
    {
        $this->teacherRate = $teacherRate;
        $this->teacherReview = $teacherReview;
        $this->classRate = $classRate;
        $this->classReview = $classReview;
        $this->sender = $sender;
    }

    public function __toString()
    {
        return "--REVIEW--\n"
        .'Note attribuée au prof :' . $this->teacherRate."\n"
        .'Note attribuéé au cours :' . $this->classRate."\n"
        .'Rédigé par :'.$this->sender."\n";
    }
}