<?php

namespace ReviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ListController extends Controller
{
    /**
     * @Route("/list", name="review_list")
     */
    public function listAction()
    {
        $reviewrepository =  new ReviewRepository();

        return $this->render('ReviewBundle:List:list.html.twig');
    }
}
