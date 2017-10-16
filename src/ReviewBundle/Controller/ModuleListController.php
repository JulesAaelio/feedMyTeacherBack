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

    /**
     * @Route("/module-list/",name="module_list")
     */
    public function listAction()
    {
        $connectedStudent = $this->getUser();
        $modules = $connectedStudent->getDivision()->getModules();

        return $this->render('ReviewBundle:StudentDashboard:moduleList.html.twig', [
            'modules' => $modules,
        ]);
    }
}