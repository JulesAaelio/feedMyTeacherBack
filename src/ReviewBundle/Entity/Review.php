<?php

namespace ReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Review
 *
 * @ORM\Table(name="review")
 * @ORM\Entity(repositoryClass="ReviewBundle\Repository\ReviewRepository")
 */
class Review
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
     * @var int
     * @Assert\Range(
     *     min = 0,
     *     max = 5,
     *     minMessage = "La note doit être comprise entre 0 et 5",
     *     maxMessage = "La note doit être comprise entre 0 et 5"
     * )
     * @ORM\Column(name="teacherRate", type="integer")
     */
    private $teacherRate;

    /**
     * @var string
     *
     * @ORM\Column(name="teacherReview", type="string", length=255)
     */
    private $teacherReview;

    /**
     * @var int
     * @Assert\Range(
     *     min = 0,
     *     max = 5,
     *     minMessage = "La note doit être comprise entre 0 et 5",
     *     maxMessage = "La note doit être comprise entre 0 et 5"
     * )
     * @ORM\Column(name="classRate", type="integer")
     */
    private $classRate;

    /**
     * @var string
     *
     * @ORM\Column(name="classReview", type="string", length=255)
     */
    private $classReview;


    /**
     * @ORM\ManyToOne(targetEntity="Module", inversedBy="reviews")
     * @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     */
    private $module;


    /**
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="reviews")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    private $sender;

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
     * Set teacherRate
     *
     * @param integer $teacherRate
     *
     * @return Review
     */
    public function setTeacherRate($teacherRate)
    {
        $this->teacherRate = $teacherRate;

        return $this;
    }

    /**
     * Get teacherRate
     *
     * @return int
     */
    public function getTeacherRate()
    {
        return $this->teacherRate;
    }

    /**
     * Set teacherReview
     *
     * @param string $teacherReview
     *
     * @return Review
     */
    public function setTeacherReview($teacherReview)
    {
        $this->teacherReview = $teacherReview;

        return $this;
    }

    /**
     * Get teacherReview
     *
     * @return string
     */
    public function getTeacherReview()
    {
        return $this->teacherReview;
    }

    /**
     * Set classRate
     *
     * @param integer $classRate
     *
     * @return Review
     */
    public function setClassRate($classRate)
    {
        $this->classRate = $classRate;

        return $this;
    }

    /**
     * Get classRate
     *
     * @return int
     */
    public function getClassRate()
    {
        return $this->classRate;
    }

    /**
     * Set classReview
     *
     * @param string $classReview
     *
     * @return Review
     */
    public function setClassReview($classReview)
    {
        $this->classReview = $classReview;

        return $this;
    }

    /**
     * Get classReview
     *
     * @return string
     */
    public function getClassReview()
    {
        return $this->classReview;
    }


    // Review::createFull
    public static function createFull(int $teacherRate,string $teacherReview,int $classRate,string $classReview,$module,$sender)
    {
        $review = new Review();
        $review->teacherRate = $teacherRate;
        $review->teacherReview = $teacherReview;
        $review->classRate = $classRate;
        $review->classReview = $classReview;
        $review->module = $module;
        $review->sender = $sender;
        return $review;
    }


    public function getClassStars()
    {
        return $this->rateToStars($this->classRate);
    }

    public function getTeacherStars()
    {
        return $this->rateToStars($this->teacherRate);
    }

    private function rateToStars($rate)
    {
        $stars = '';
        for($i = 0;$i < 5;$i++)
        {
            if($i < $rate)
            {
                $stars.= 'H';
            }else
            {
                $stars.='G';
            }
        }
        return $stars;
    }

    public function __toString()
    {
        return 'Avis n°'.$this->id.' de '.$this->sender;
    }

    /**
     * @return mixed
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param mixed $module
     */
    public function setModule($module)
    {
        $this->module = $module;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param mixed $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }


}

