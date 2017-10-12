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
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentDashboardController extends Controller
{
    /**
     * @Route("/",name="root")
     * @Route("/review/{moduleId}", name="student_dashboard")
     */
    public function createReview(Request $request, $moduleId = null)
    {
//        $studentRepository = $this->getDoctrine()->getRepository(Student::class);
//        $connectedStudent = $studentRepository->find(8);

        $connectedStudent = $this->getUser();


        $modules = $connectedStudent->getDivision()->getModules();
        $module = null;
        $review = null;
        if($moduleId) {
            $moduleRepository = $this->getDoctrine()->getRepository(Module::class);
            $module = $moduleRepository->find($moduleId);

            $reviewRepository = $this->getDoctrine()->getRepository(Review::class);
            $review = $reviewRepository->findBy(array('module'=>$module,'sender'=>$connectedStudent));

        }
        $form = $this->createForm(ReviewType::class, new Review());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $newReview = $form->getData();
            $newReview->setModule($module);
            $newReview->setSender($connectedStudent);

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $em = $this->getDoctrine()->getManager();
             $em->persist($newReview);
             $em->flush();

            return $this->redirectToRoute('task_success');
        }




        return $this->render('ReviewBundle:StudentDashboard:studentDashboard.html.twig', [
            'modules' => $modules,
            'module' => $module,
            'review' => $review,
            'form' => $form->createView(),
        ]);
    }
}


