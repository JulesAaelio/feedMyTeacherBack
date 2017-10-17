<?php
/**
 * Created by PhpStorm.
 * User: Jules LAURENT
 * Date: 16/10/2017
 * Time: 22:24
 */

namespace ReviewBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TeacherDashboardController extends Controller
{
    /**
     * @Route("/report/{moduleId}", name="teacher_dashboard")
     */
    public function showAction($moduleId = null)
    {
        return $this->render('ReviewBundle:TeacherDashboard:dashboard.html.twig',[
            'moduleId'=>$moduleId
        ]);
    }
}