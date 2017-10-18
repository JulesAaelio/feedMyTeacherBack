<?php
/**
 * Created by PhpStorm.
 * User: Jules LAURENT
 * Date: 16/10/2017
 * Time: 20:59
 */

namespace ReviewBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ReviewBundle\Entity\User;

class ModuleListController extends Controller
{

    public function listAction()
    {
        $modules = $this->getModules();

        return $this->render('ReviewBundle:StudentDashboard:moduleList.html.twig', [
            'modules' => $modules,
        ]);
    }

    public function listForTeacherAction()
    {
       $modules = $this->getModules();

        return $this->render('ReviewBundle:TeacherDashboard:moduleList.html.twig', [
            'modules' => $modules,
        ]);
    }

    public function listForRepresentativeAction()
    {
        $modules = $this->getModules();

        return $this->render('ReviewBundle:RepresentativeDashboard:moduleList.html.twig', [
            'modules' => $modules,
        ]);

    }

    private function getModules()
    {
        $connectedUser = $this->getUser();
        if(in_array('ROLE_TEACHER',$connectedUser->getRoles()))
        {
            $modules = $connectedUser->getModules();
        }else
        {
            $modules =  $connectedUser->getDivision()->getModules();
        }
        return $modules;
    }
}