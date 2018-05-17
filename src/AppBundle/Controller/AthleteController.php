<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Athlete;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Athlete controller.
 *
 * @Route("athlete")
 */
class AthleteController extends Controller
{
    /**
     * Lists all athlete entities.
     *
     * @Route("/", name="athlete_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $athletes = $em->getRepository('AppBundle:Athlete')->findAll();

        return $this->render('athlete/index.html.twig', array(
            'athletes' => $athletes,
        ));
    }

    /**
     * Creates a new athlete entity.
     *
     * @Route("/new", name="athlete_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $athlete = new Athlete();
        $form = $this->createForm('AppBundle\Form\AthleteType', $athlete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($athlete);
            $em->flush();

            return $this->redirectToRoute('athlete_show', array('id' => $athlete->getId()));
        }

        return $this->render('athlete/admin_new.html.twig', array(
            'athlete' => $athlete,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a athlete entity.
     *
     * @Route("/{id}", name="athlete_show")
     * @Method("GET")
     */
    public function showAction(Athlete $athlete)
    {
        $deleteForm = $this->createDeleteForm($athlete);

        return $this->render('athlete/show.html.twig', array(
            'athlete' => $athlete,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing athlete entity.
     *
     * @Route("/{id}/edit", name="athlete_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Athlete $athlete)
    {
        $deleteForm = $this->createDeleteForm($athlete);
        $editForm = $this->createForm('AppBundle\Form\AthleteType', $athlete);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('athlete_edit', array('id' => $athlete->getId()));
        }

        return $this->render('athlete/admin_edit.html.twig', array(
            'athlete' => $athlete,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a athlete entity.
     *
     * @Route("/{id}", name="athlete_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Athlete $athlete)
    {
        $form = $this->createDeleteForm($athlete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($athlete);
            $em->flush();
        }

        return $this->redirectToRoute('athlete_index');
    }

    /**
     * Creates a form to delete a athlete entity.
     *
     * @param Athlete $athlete The athlete entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Athlete $athlete)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('athlete_delete', array('id' => $athlete->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
