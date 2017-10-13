<?php

namespace UserBundle\Controller;

use ReviewBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use UserBundle\Form\StudentType;
use ReviewBundle\Entity\User;

class SecurityController extends Controller

{
    /**
     * @Route("/login",name="login")
     */
    public function loginAction(Request $request)
    {
        // get the login error if there is one
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('UserBundle:Security:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/register",name="register")
     */
    public function registerAction(Request $request)
    {

        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newStudent = $form->getData();

            //ENCODE PASSWORD
            $encoder = $this->get('security.password_encoder');
            $student->setPassword($encoder->encodePassword($newStudent,$newStudent->getPassword()));

            //BE SURE THAT THE LAST NAME IS CAPS
            $student->setLastName(strtoupper($student->getLastName()));

            //SAVE NEW ENTITY
            $em = $this->getDoctrine()->getManager();
            $em->persist($newStudent);
            $em->flush();

            return $this->redirectToRoute('root');
        }
        $formView = $form->createView();
        return $this->render('UserBundle:Security:register.html.twig',array('form'=>$form->createView()));
    }
}
