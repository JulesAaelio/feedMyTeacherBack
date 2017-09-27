<?php

namespace ReviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ReviewBundle\Entity;
use ReviewBundle\Repository\ReviewRepository;

class ListController extends Controller
{
    /**
     * @Route("/list", name="review_list")
     */
    public function listAction()
    {
        $reviewRepository =  new ReviewRepository();
        $reviews = $reviewRepository->getAllReviews();
        return $this->render('ReviewBundle:List:list.html.twig',[
            'reviews'=> $reviews
        ]);
    }
}
