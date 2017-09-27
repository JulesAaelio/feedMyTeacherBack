<?php
/**
 * Created by PhpStorm.
 * User: Alexandra
 * Date: 27/09/2017
 * Time: 16:09
 */

namespace ReviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DetailController extends Controller
{
    /**
     * @Route("/detail", name="review_detail")
     */
    public function detailAction()
    {
        return $this->render('ReviewBundle:Detail:detail.html.twig');
    }
}


