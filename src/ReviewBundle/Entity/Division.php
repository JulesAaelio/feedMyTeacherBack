<?php

namespace ReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Division
 *
 * @ORM\Table(name="division")
 * @ORM\Entity(repositoryClass="ReviewBundle\Repository\DivisionRepository")
 */
class Division
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
     * @var string
     *
     * @ORM\Column(name="school", type="string", length=255)
     */
    private $school;

    /**
     * @var string
     *
     * @ORM\Column(name="grade", type="string", length=255)
     */
    private $grade;

    /**
     * @ORM\OneToMany(targetEntity="Student", mappedBy="division")
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity="Module", mappedBy="division")
     */
    private $modules;


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
     * Set school
     *
     * @param string $school
     *
     * @return Division
     */
    public function setSchool($school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return string
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Set grade
     *
     * @param string $grade
     *
     * @return Division
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return string
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * @return mixed
     */
    public function getModules()
    {
        return $this->modules;
    }

    /**
     * @param mixed $modules
     */
    public function setModules($modules)
    {
        $this->modules = $modules;
    }



    public function __construct(string $school,string $grade)
    {
        $this->school = $school;
        $this->grade = $grade;
    }
}

