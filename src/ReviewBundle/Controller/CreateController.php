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
        $em = $this->getDoctrine()->getManager();

        $em->persist(new Review(5, 'tip_top', 0, 'pas tip top'));
        $em->persist(new Review(5, 'tik tok', 5, 'Make the party non stop'));
        $em->persist(new Review(5, 'MA-CHA-LAH LE PROF', 1, 'Pas écouté. Je regardais le prof'));

        $em->flush();

        return new Response('OK');
    }
}


