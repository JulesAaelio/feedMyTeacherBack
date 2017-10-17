<?php

namespace ReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ReviewBundle\Entity\Review;
use Symfony\Component\Validator\Constraints\RangeValidator;

/**
 * Module
 *
 * @ORM\Table(name="module")
 * @ORM\Entity(repositoryClass="ReviewBundle\Repository\ModuleRepository")
 */
class Module
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Subject", inversedBy="modules")
     * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
     */
    private $subject;

    /**
     * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="modules")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id")
     */
    private $teacher;

    /**
     * @ORM\ManyToOne(targetEntity="Division", inversedBy="modules")
     * @ORM\JoinColumn(name="division_id", referencedColumnName="id")
     */
    private $division;

    /**
     * @ORM\OneToMany(targetEntity="Review", mappedBy="module")
     */
    private $reviews;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Module
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set teacher
     *
     * @param string $teacher
     *
     * @return Module
     */
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return string
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set division
     *
     * @param string $division
     *
     * @return Module
     */
    public function setDivision($division)
    {
        $this->division = $division;

        return $this;
    }

    /**
     * Get division
     *
     * @return string
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

//    public function __construct($subject,$teacher,$division)
//    {
//        $this->subject = $subject;
//        $this->teacher = $teacher;
//        $this->division = $division;
//    }

    public static function createFull($subject,$teacher,$division)
    {
        $module = new Module();
        $module->subject = $subject;
        $module->teacher = $teacher;
        $module->division = $division;
        return $module;
    }

    public function __toString()
    {
        return $this->subject.'+'.$this->teacher.'['.$this->division.']';
    }

    public function getAverageClassRate()
    {
        $reviews = $this->getReviews();
        if(count($reviews) <= 0)
            return 0;
        $sum = 0;
        foreach ($reviews as $review)
        {
            $sum += $review->getClassRate();
        }
        return  $sum / count($reviews);
    }

    public function getAverageClassRateStars()
    {
        return Review::rateToStars($this->getAverageClassRate());
    }

    public function getAverageTeacherRate()
    {
        $reviews = $this->getReviews();
        if(count($reviews) <= 0)
            return 0;
        $sum = 0;
        foreach ($reviews as $review)
        {
            $sum += $review->getTeacherRate();
        }

        return  $sum / count($reviews);
    }

    public function getAverageTeacherRateStars()
    {
        return Review::rateToStars($this->getAverageTeacherRate());
    }


}

