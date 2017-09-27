<?php
/**
 * Created by PhpStorm.
 * User: Alexandra
 * Date: 27/09/2017
 * Time: 16:09
 */

namespace ReviewBundle\Controller;

use ReviewBundle\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DetailController extends Controller
{
    /**
     * @Route("/detail/{controllerIndex}", name="review_detail")
     */
    public function detailAction($controllerIndex = 0)
    {
        $reviewRepository = new ReviewRepository();
        $reviews = $reviewRepository->getAllReviews();
        $review = $reviews[$controllerIndex];
        return $this->render('ReviewBundle:Detail:detail.html.twig',[
            'review' => $review,
        ]);
    }
}


