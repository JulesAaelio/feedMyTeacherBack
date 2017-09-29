<?php
/**
 * Created by PhpStorm.
 * User: Alexandra
 * Date: 27/09/2017
 * Time: 16:09
 */

namespace ReviewBundle\Controller;

use ReviewBundle\Entity\Review;
use ReviewBundle\Repository\ReviewRepositoryTmp;
use ReviewBundle\ReviewBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DetailController extends Controller
{
    /**
     * @Route("/detail/{controllerIndex}", name="review_detail")
     */
    public function detailAction($controllerIndex = 1)
    {

//        $reviewRepository = new ReviewRepositoryTmp();
        $reviewRepository = $this->getDoctrine()->getRepository(Review::class);
        $review = $reviewRepository->find($controllerIndex);

//        $reviews = $reviewRepository->getAllReviews();
        if(!isset($review))
        {
            throw $this->createNotFoundException('');
        }
//        $review = $reviews[$controllerIndex];
        return $this->render('ReviewBundle:Detail:detail.html.twig',[
            'review' => $review,
        ]);
    }
}


