<?php
/**
 * Created by PhpStorm.
 * User: Jules LAURENT
 * Date: 21/10/2017
 * Time: 21:14
 */

namespace AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ReviewBundle\Entity\Student;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ApprobationController extends Controller
{
    /**
     * @Route("/admin/approbation-dashboard",name="approbation_index")
     */
    function listAction()
    {
        $studentRepository = $this->getDoctrine()->getRepository(Student::class);
        $studentsWaiting = $studentRepository->findBy(['isActive'=>false]);
        return $this->render('AdminBundle:Approbation:list.html.twig',[
            'students' => $studentsWaiting
        ]);
    }

    /**
     * @Route("/admin/approve/{studentId}/{approve}",name="approbation_proceed")
     */
    function approveAction($studentId,$approve = 'true')
    {
        $em = $this->getDoctrine()->getManager();
        $studentRepository = $this->getDoctrine()->getRepository(Student::class);
        $student = $studentRepository->find($studentId);

        if($approve == 'true')
        {
            $student->setIsActive(true);
            $em->persist($student);
            $em->flush();
            $this->addFlash(
                'success',
                json_encode(['title'=>"Opération réussie",
                'message'=>"L'utilisateur à été approuvé"],JSON_UNESCAPED_UNICODE)
            );
        }else
        {
            $em->remove($student);
            $em->persist($student);
            $em->flush();
            $this->addFlash(
                'warning',
                json_encode(['title'=>"Opération réussie ! ",
                    'message'=>"L'utilisateur à été supprimé !"],JSON_UNESCAPED_UNICODE)

            );
        }
        return $this->redirectToRoute('approbation_index');
    }
}