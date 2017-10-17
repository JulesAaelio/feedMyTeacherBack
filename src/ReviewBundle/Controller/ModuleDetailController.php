<?php
/**
 * Created by PhpStorm.
 * User: Jules LAURENT
 * Date: 16/10/2017
 * Time: 21:03
 */

namespace ReviewBundle\Controller;


use ReviewBundle\Entity\Module;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ModuleDetailController extends Controller
{
    public function detailAction($moduleId = null)
    {
        $module = $this->getModule($moduleId);
        return $this->render('ReviewBundle:StudentDashboard:moduleDetail.html.twig', [
            'module' => $module,
        ]);
    }

    public function detailForTeacherAction($moduleId = null)
    {
        $module = $this->getModule($moduleId);
        return $this->render('ReviewBundle:TeacherDashboard:moduleDetail.html.twig', [
            'module' => $module,
        ]);
    }

    private function getModule($moduleId)
    {
        $module = null;
        if($moduleId) {
            $moduleRepository = $this->getDoctrine()->getRepository(Module::class);
            $module = $moduleRepository->find($moduleId);
        }
        return $module;
    }
}