<?php
/**
 * Created by PhpStorm.
 * User: Alexandra
 * Date: 27/09/2017
 * Time: 16:09
 */

namespace ReviewBundle\Controller;

use ReviewBundle\Entity\Review;
use ReviewBundle\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class CreateController extends Controller
{
    /**
     * @Route("/new", name="new")
     */
    public function createReview()
    {
        return new Response('OK');
    }
}


