<?php

namespace ReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 *
 * @ORM\Entity(repositoryClass="ReviewBundle\Repository\StudentRepository")
 */
class Student extends User
{
//    /**
//     * @var int
//     *
//     * @ORM\Column(name="id", type="integer")
//     * @ORM\Id
//     * @ORM\GeneratedValue(strategy="AUTO")
//     */
//    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Division", inversedBy="students")
     * @ORM\JoinColumn(name="division_id", referencedColumnName="id")
     */
    private $division;

    /**
     * @ORM\OneToMany(targetEntity="Review", mappedBy="sender")
     */
    private $reviews;




//    /**
//     * Get id
//     *
//     * @return int
//     */
//    public function getId()
//    {
//        return $this->id;
//    }

    /**
     * Set division
     *
     * @param string $division
     *
     * @return Student
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

    public function __construct($firstName = null , $lastName = null, $email = null ,$division = null )
    {
        parent::__construct($firstName, $lastName, $email);
        $this->division = $division;
        $this->addRole('ROLE_STUDENT');
    }

    public function __toString()
    {
        return parent::__toString().'['.$this->division.']';
    }
}

