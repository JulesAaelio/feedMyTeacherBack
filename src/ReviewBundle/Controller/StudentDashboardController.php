<?php
/**
 * Created by PhpStorm.
 * User: Alexandra
 * Date: 27/09/2017
 * Time: 16:09
 */

namespace ReviewBundle\Controller;

use ReviewBundle\Entity\Module;
use ReviewBundle\Entity\Review;
use ReviewBundle\Entity\Student;
use ReviewBundle\Form\ReviewType;
use ReviewBundle\Repository\ReviewRepository;
use ReviewBundle\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentDashboardController extends Controller
{
    /**
     * @Route("/",name="root")
     * @Route("/review/{moduleId}", name="student_dashboard")
     */
    public function showAction($moduleId)
    {
        return $this->render('ReviewBundle:StudentDashboard:dashboard.html.twig',[
            'moduleId'=>$moduleId
        ]);
    }
}


