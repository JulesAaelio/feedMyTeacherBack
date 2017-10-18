<?php
/**
 * Created by PhpStorm.
 * User: Jules LAURENT
 * Date: 16/10/2017
 * Time: 21:06
 */

namespace ReviewBundle\Controller;

use ReviewBundle\Entity\Module;
use ReviewBundle\Entity\Review;
use ReviewBundle\Form\ReviewTypeTmp;
use ReviewBundle\Form\StudentReviewType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReviewDisplayController extends Controller
{
    public function displayOwnAction(Request $request,$moduleId = null)
    {
        // GET USER AND PARENT REQUEST
        $connectedStudent = $this->getUser();
        $request = $request->createFromGlobals();

        // GET CURRENT REVIEW IF EXIST
        $moduleRepository = $this->getDoctrine()->getRepository(Module::class);
        $module = $moduleRepository->find($moduleId);
        $reviewRepository = $this->getDoctrine()->getRepository(Review::class);
        $review = $reviewRepository->findOneBy(array('module'=>$module,'sender'=>$connectedStudent));

        if($review) //IF A REVIEW THERE IS THEN DISPLAY IT WE MUST
        {
            return $this->render('ReviewBundle:Dashboard:review.html.twig', [
                'review' => $review,
                'anonymous' => true,
            ]);
        }else {// CREATE AND HANDLE FORM IF REVIEW DO NOT EXIST
            $form = $this->createForm(StudentReviewType::class, new Review());
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $newReview = $form->getData();
                $newReview->setModule($module);
                $newReview->setSender($connectedStudent);

                $em = $this->getDoctrine()->getManager();
                $em->persist($newReview);
                $em->flush();

                return $this->render('ReviewBundle:Dashboard:review.html.twig', [
                'review' => $newReview,
                'anonymous' => true,
            ]);
            }
            return $this->render('ReviewBundle:StudentDashboard:reviewForm.html.twig', [
                'form' => $form->createView(),
            ]);
        }
    }

    public function createAction()
    {

    }


    public function displayAllAction(Request $request,$moduleId = null,$anonymous = true)
    {
        // GET USER AND PARENT REQUEST
        $connectedUser = $this->getUser();
        $request = $request->createFromGlobals();

        // GET CURRENT REVIEW IF EXIST
        $moduleRepository = $this->getDoctrine()->getRepository(Module::class);
        $module = $moduleRepository->find($moduleId);
        $reviewRepository = $this->getDoctrine()->getRepository(Review::class);
        $reviews = $reviewRepository->findBy(array('module'=>$module));

        return $this->render('ReviewBundle:Dashboard:reviews.html.twig', [
            'reviews' => $reviews,
            'anonymous' => $anonymous,
        ]);
    }
}