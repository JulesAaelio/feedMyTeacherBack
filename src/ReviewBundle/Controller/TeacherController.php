<?php

namespace ReviewBundle\Controller;

use ReviewBundle\Entity\Teacher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Teacher controller.
 *
 * @Route("admin/teachers")
 */
class TeacherController extends Controller
{
    /**
     * Lists all teacher entities.
     *
     * @Route("/", name="admin_teachers_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $teachers = $em->getRepository('ReviewBundle:Teacher')->findAll();

        return $this->render('teacher/index.html.twig', array(
            'users' => $teachers,
        ));
    }

    /**
     * Creates a new teacher entity.
     *
     * @Route("/new", name="admin_teachers_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $teacher = new Teacher();
        $form = $this->createForm('ReviewBundle\Form\TeacherType', $teacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($teacher);
            $em->flush();

            return $this->redirectToRoute('admin_teachers_show', array('id' => $teacher->getId()));
        }

        return $this->render('teacher/new.html.twig', array(
            'user' => $teacher,
            'form' => $form->createView()
        ));
    }

    /**
     * Finds and displays a teacher entity.
     *
     * @Route("/{id}", name="admin_teachers_show")
     * @Method("GET")
     */
    public function showAction(Teacher $teacher)
    {
        $deleteForm = $this->createDeleteForm($teacher);

        return $this->render('teacher/show.html.twig', array(
            'user' => $teacher,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing teacher entity.
     *
     * @Route("/{id}/edit", name="admin_teachers_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Teacher $teacher)
    {
        $deleteForm = $this->createDeleteForm($teacher);
        $editForm = $this->createForm('ReviewBundle\Form\TeacherType', $teacher);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_teachers_edit', array('id' => $teacher->getId()));
        }

        return $this->render('teacher/edit.html.twig', array(
            'user' => $teacher,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a teacher entity.
     *
     * @Route("/{id}", name="admin_teachers_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Teacher $teacher)
    {
        $form = $this->createDeleteForm($teacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($teacher);
            $em->flush();
        }

        return $this->redirectToRoute('admin_teachers_index');
    }

    /**
     * Creates a form to delete a teacher entity.
     *
     * @param Teacher $teacher The teacher entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Teacher $teacher)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_teachers_delete', array('id' => $teacher->getId())))
            ->setMethod('DELETE')
            ->add('save', SubmitType::class, array('label' => "SUPPRIMER",'attr'=>array('class'=>'btn-red btn-block btn-lg')))
            ->getForm()
        ;
    }
}