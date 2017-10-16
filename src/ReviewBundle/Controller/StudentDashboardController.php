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
//    public function createReview(Request $request)
//    {
//        $connectedStudent = $this->getUser();
//        $moduleId = $request->get('moduleId') ?? null;
//
//        $modules = $connectedStudent->getDivision()->getModules();
//        $module = null;
//        $review = null;
//        $formView = null;
//
//        // GET MODULE
//        if($moduleId) {
//            $moduleRepository = $this->getDoctrine()->getRepository(Module::class);
//            $module = $moduleRepository->find($moduleId);
//        }
//
//        // GET CURRENT REVIEW IF EXIST
//        $reviewRepository = $this->getDoctrine()->getRepository(Review::class);
//        $reviews = $reviewRepository->findBy(array('module'=>$module,'sender'=>$connectedStudent));
//        if(count($reviews) > 0)
//        {
//            $review = $reviews[0];
//        }
//        else {// CREATE AND HANDLE FORM IF REVIEW DO NOT EXIST
//            $form = $this->createForm(ReviewType::class, new Review());
//            $form->handleRequest($request);
//
//            if ($form->isSubmitted() && $form->isValid()) {
//                $newReview = $form->getData();
//                $newReview->setModule($module);
//                $newReview->setSender($connectedStudent);
//
//                $em = $this->getDoctrine()->getManager();
//                $em->persist($newReview);
//                $em->flush();
//
//                return $this->redirectToRoute('student_dashboard', array('moduleId' => $moduleId));
//            }
//            $formView = $form->createView();
//        }
//
//        return $this->render('ReviewBundle:StudentDashboard:studentDashboard.html.twig', [
//            'modules' => $modules,
//            'module' => $module,
//            'review' => $review,
//            'form' => $formView,
//        ]);
//    }
}


