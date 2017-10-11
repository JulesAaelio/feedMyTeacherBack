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
use ReviewBundle\Repository\ReviewRepository;
use ReviewBundle\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class StudentDashboardController extends Controller
{
    /**
     * @Route("/",name="root")
     * @Route("/review/{moduleId}", name="student_dashboard")
     */
    public function createReview($moduleId = null)
    {
        $studentRepository = $this->getDoctrine()->getRepository(Student::class);
        $connectedStudent = $studentRepository->find(8);

        $modules = $connectedStudent->getDivision()->getModules();
        $module = null;
        $review = null;
        if($moduleId) {
            $moduleRepository = $this->getDoctrine()->getRepository(Module::class);
            $module = $moduleRepository->find($moduleId);

            $reviewRepository = $this->getDoctrine()->getRepository(Review::class);
            $review = $reviewRepository->findBy(array('module'=>$module,'sender'=>$connectedStudent));

        }




        return $this->render('ReviewBundle:StudentDashboard:studentDashboard.html.twig', [
            'modules' => $modules,
            'module' => $module,
            'review' => $review,
        ]);
    }
}


