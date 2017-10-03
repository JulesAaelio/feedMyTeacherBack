<?php

namespace ReviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ReviewBundle\Entity;
use ReviewBundle\Entity\ReviewTmp;
use ReviewBundle\Repository\ReviewRepositoryTmp;
use Symfony\Component\HttpFoundation\Request;

class ListController extends Controller
{
    /**
     * @Route("/list", name="review_list")
     */
    public function listAction(Request $request)
    {
        $refValue= $request->get('refvalue');
        $order= $request->get('order');
        $reviewRepository =  new ReviewRepositoryTmp();
        $reviews = $reviewRepository->getAllReviews();
        usort($reviews,$this->buildSorter($refValue,$order));
        return $this->render('ReviewBundle:List:list.html.twig',[
            'reviews'=> $reviews
        ]);
    }

    public static function buildSorter($refValue,$order)
    {
        return function ($a,$b) use ($refValue,$order)
        {

            if($refValue == 'class')
            {
                $a = $a->getClassRate();
                $b = $b->getClassRate();
            }
            else if($refValue == 'teacher')
            {
                $a = $a->getTeacherRate();
                $b = $b->getTeacherRate();
            }

            return $order == 'ASC' ?
                $a <=> $b :
                $b <=> $a
                ;

            return $result;
        };
    }
}