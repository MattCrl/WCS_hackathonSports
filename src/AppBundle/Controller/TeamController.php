<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Athlete;
use AppBundle\Entity\Game;
use AppBundle\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Team controller.
 *
 */
class TeamController extends Controller
{
    /**
     * Lists all team entities.
     *
     * @Route("/team", name="team_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $teams = $em->getRepository('AppBundle:Team')->findAll();

        return $this->render('team/index.html.twig', array(
            'teams' => $teams,
        ));
    }

    /**
     * Admin Lists all team entities.
     *
     * @Route("admin/team", name="admin_team_index")
     * @Method("GET")
     */
    public function adminIndexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $teams = $em->getRepository('AppBundle:Team')->findAll();

        return $this->render('team/admin_index.html.twig', array(
            'teams' => $teams,
        ));
    }

    /**
     * Creates a new team entity.
     *
     * @Route("admin/new", name="admin_team_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $team = new Team();
        $form = $this->createForm('AppBundle\Form\TeamType', $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($team);
            $em->flush();

            return $this->redirectToRoute('admin_team_show', array('id' => $team->getId()));
        }

        return $this->render('team/admin_new.html.twig', array(
            'team' => $team,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a team entity.
     *
     * @Route("/team/{id}", name="team_show")
     * @Method("GET")
     */
    public function showAction(Team $team)
    {
        $deleteForm = $this->createDeleteForm($team);
        $players = $this->getPlayers($team);
        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository('AppBundle:Game')->getLastMatch($team);
        if(count($match)==0){
            $match[0]=null;
        }
        return $this->render('team/show.html.twig', array(
            'team' => $team,
            'players' => $players,
            'match' => $match[0],
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Finds and displays a team entity.
     *
     * @Route("admin/team/{id}", name="admin_team_show")
     * @Method("GET")
     */
    public function adminShowAction(Team $team)
    {
        $deleteForm = $this->createDeleteForm($team);
        $players = $this->getPlayers($team);
        $em = $this->getDoctrine()->getManager();
        $match = $em->getRepository('AppBundle:Game')->getLastMatch($team);
        if(count($match)==0){
            $match[0]=null;
        }
        return $this->render('team/admin_show.html.twig', array(
            'team' => $team,
            'players' => $players,
            'match' => $match[0],
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing team entity.
     *
     * @Route("admin/team/{id}/edit", name="admin_team_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Team $team)
    {
        $deleteForm = $this->createDeleteForm($team);
        $editForm = $this->createForm('AppBundle\Form\TeamType', $team);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_team_edit', array('id' => $team->getId()));
        }

        return $this->render('team/admin_edit.html.twig', array(
            'team' => $team,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a team entity.
     *
     * @Route("/{id}", name="team_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Team $team)
    {
        $form = $this->createDeleteForm($team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($team);
            $em->flush();
        }

        return $this->redirectToRoute('admin_team_index');
    }

    /**
     * Creates a form to delete a team entity.
     *
     * @param Team $team The team entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Team $team)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('team_delete', array('id' => $team->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function getPlayers(Team $team)
    {
        $em = $this->getDoctrine()->getManager();
        $athletes = $em->getRepository(Athlete::class)->findByTeam($team);
        return $athletes;
    }

    /**
     * Get the last match of a team
     *
     * @param Team $team
     *
     * @return Team
     */
    public function getLastMatch(Team $team)
    {
        $em = $this->getDoctrine()->getManager();
        $query = 'SELECT * FROM game WHERE game.team1_id = '.$team->getId().' OR game.team2_id = '.$team->getId().' ORDER BY start_at LIMIT 1;';

        $statement = $em->getConnection()->prepare($query);
        $match = $statement->execute();
        return $match;
    }

}
