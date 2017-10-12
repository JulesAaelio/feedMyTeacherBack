<?php

namespace ReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teacher
 *
 * @ORM\Entity(repositoryClass="ReviewBundle\Repository\TeacherRepository")
 */
class Teacher extends User
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
     * @ORM\OneToMany(targetEntity="Module", mappedBy="teacher")
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

    public function __construct($firstName, $lastName)
    {
        parent::__construct($firstName, $lastName);
        $this->addRole('ROLE_TEACHER');
    }

}

