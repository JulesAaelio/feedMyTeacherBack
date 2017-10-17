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

class DashboardController extends Controller
{
    /**
     * @Route("/",name="root")
     * @Route("/review/{moduleId}", name="student_dashboard")
     * @Route("/report/{moduleId}", name="teacher_dashboard")
     */
    public function showAction($moduleId = null)
    {
        $connectedUser = $this->getUser();
        $template = 'ReviewBundle:StudentDashboard:dashboard.html.twig';
        if(in_array('ROLE_TEACHER',$connectedUser->getRoles()))
        {
            $template = 'ReviewBundle:TeacherDashboard:dashboard.html.twig';
        }
        return $this->render($template,[
            'moduleId'=>$moduleId
        ]);
    }
}