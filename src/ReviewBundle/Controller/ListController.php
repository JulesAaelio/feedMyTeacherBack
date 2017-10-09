<?php

namespace ReviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ReviewBundle\Entity;
use ReviewBundle\Entity\Review;
use ReviewBundle\Repository\ReviewRepository;
use Symfony\Component\HttpFoundation\Request;

class ListController extends Controller
{
    /**
     * @Route("/list", name="review_list")
     * @Route("/", name="homepage")
     */
    public function listAction(Request $request)
    {
        $sortBy = $request->get('sortby') ?? 'id';
        $order = $request->get('order') ?? 'ASC';
        $reviewRepository = $this->getDoctrine()->getRepository(Review::class);
        $reviews = $reviewRepository->findBy(array(),array($sortBy => $order));
        return $this->render('ReviewBundle:List:list.html.twig', [
            'reviews' => $reviews
        ]);
    }
}