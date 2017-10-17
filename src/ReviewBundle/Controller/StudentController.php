<?php

namespace ReviewBundle\Controller;

use ReviewBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Student controller.
 *
 * @Route("admin/students")
 */
class StudentController extends Controller
{
    /**
     * Lists all student entities.
     *
     * @Route("/", name="admin_students_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $students = $em->getRepository('ReviewBundle:Student')->findAll();
        return $this->render('student/index.html.twig', array(
            'users' => $students
        ));
    }

    /**
     * Creates a new student entity.
     *
     * @Route("/new", name="admin_students_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $student = new Student();
        $form = $this->createForm('ReviewBundle\Form\StudentType', $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();

            return $this->redirectToRoute('admin_students_show', array('id' => $student->getId()));
        }

        return $this->render('student/new.html.twig', array(
            'user' => $student,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a student entity.
     *
     * @Route("/{id}", name="admin_students_show")
     * @Method("GET")
     */
    public function showAction(Student $student)
    {
        $deleteForm = $this->createDeleteForm($student);

        return $this->render('student/show.html.twig', array(
            'user' => $student,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing student entity.
     *
     * @Route("/{id}/edit", name="admin_students_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Student $student)
    {
        $deleteForm = $this->createDeleteForm($student);
        $editForm = $this->createForm('ReviewBundle\Form\StudentType', $student);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_students_edit', array('id' => $student->getId()));
        }

        return $this->render('student/edit.html.twig', array(
            'user' => $student,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a student entity.
     *
     * @Route("/{id}", name="admin_students_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Student $student)
    {
        $form = $this->createDeleteForm($student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($student);
            $em->flush();
        }

        return $this->redirectToRoute('admin_students_index');
    }

    /**
     * Creates a form to delete a student entity.
     *
     * @param Student $student The student entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Student $student)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_students_delete', array('id' => $student->getId())))
            ->setMethod('DELETE')
            ->add('save', SubmitType::class, array('label' => "SUPPRIMER",'attr'=>array('class'=>'btn-red btn-block btn-lg')))
            ->getForm()
        ;
    }
}
