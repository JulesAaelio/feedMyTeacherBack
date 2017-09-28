<?php
namespace ReviewBundle\Entity;

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
            return 'Avis de '.$this->sender.' '.$this->classRate.' '.$this->teacherRate;
    }

    /**
     * @return mixed
     */
    public function getTeacherRate()
    {
        return $this->teacherRate;
    }

    /**
     * @return mixed
     */
    public function getTeacherReview()
    {
        return $this->teacherReview;
    }

    /**
     * @return mixed
     */
    public function getClassRate()
    {
        return $this->classRate;
    }

    /**
     * @return mixed
     */
    public function getClassReview()
    {
        return $this->classReview;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }


}