<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Game;
use AppBundle\Entity\Tournament;
use AppBundle\Form\GameType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tournament controller.
 *
 */
class TournamentController extends Controller
{

    /**
     * Lists all tournament entities.
     *
     * @Route("/archives", name="tournament_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tournaments = $em->getRepository('AppBundle:Tournament')->findAll();

        return $this->render('tournament/index.html.twig', array(
            'tournaments' => $tournaments,
        ));
    }

    /**
     * ADMIN List all tournament entities.
     *
     * @Route("admin/tournament", name="admin_tournament_index")
     * @Method("GET")
     */
    public function AdminIndexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tournaments = $em->getRepository('AppBundle:Tournament')->findAll();

        return $this->render('tournament/admin_index.html.twig', array(
            'tournaments' => $tournaments,
        ));
    }

    private function generateSubGames(Game $game, Tournament $tournament, $levelMax, $currentLevel = 0)
    {
        $game->setTournament($tournament);
        $game->setLevel($currentLevel);
        if ($currentLevel < $levelMax) {
            $currentLevel++;
            $prev1 = $this->generateSubGames(new Game(), $tournament, $levelMax, $currentLevel);
            $prev2 = $this->generateSubGames(new Game(), $tournament, $levelMax, $currentLevel);

            $game->setPrevGame1($prev1);
            $game->setPrevGame2($prev2);
        }

        return $game;

    }


    /**
     * Creates a new tournament entity.
     *
     * @Route("admin/tournament/new", name="admin_tournament_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tournament = new Tournament();
        $form = $this->createForm('AppBundle\Form\TournamentType', $tournament);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($tournament);
            $maxLevel = 0;
            $nbMatches = $tournament->getNbTeams() / 2;
            while ($nbMatches > 1) {
                $maxLevel++;
                $nbMatches = $nbMatches / 2;
            }

            $finale = $this->generateSubGames(new Game(), $tournament, $maxLevel);
            $em->persist($finale);
            $em->flush();

            return $this->redirectToRoute('admin_tournament_edit', array('id' => $tournament->getId()));
        }

        return $this->render('tournament/admin_new.html.twig', array(
            'tournament' => $tournament,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays last tournament entity.
     *
     * @Route("tournament", name="tournament_last_show")
     * @Method("GET")
     */
    public function showLast()
    {
        $em = $this->getDoctrine()->getManager();
        $tournament = $em->getRepository(Tournament::class)->findOneByHighestId();

        return $this->render('tournament/show.html.twig', array(
            'tournament' => $tournament,
        ));
    }

    /**
     * Finds and displays a tournament entity.
     *
     * @Route("archives/{id}", name="tournament_show")
     * @Method("GET")
     */
    public function showAction(Tournament $tournament)
    {
        $deleteForm = $this->createDeleteForm($tournament);

        return $this->render('tournament/show.html.twig', array(
            'tournament' => $tournament,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tournament entity.
     *
     * @Route("admin/tournament/{id}/edit", name="admin_tournament_edit")
     * @Route("admin/tournament/{id}/edit/{game_id}", name="admin_tournament_game_edit")
     * @ParamConverter("game", class="AppBundle:Game", options={"id" = "game_id"})
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tournament $tournament, Game $game = null)
    {
        $deleteForm = $this->createDeleteForm($tournament);
        $editForm = $this->createForm('AppBundle\Form\TournamentType', $tournament);
        $editForm->handleRequest($request);

        $editGameFormView = $game ? $this->createForm(GameType::class, $game,
            ['action' => $this->generateUrl('admin_game_edit', ['id' => $game->getId()])]
        )->createView() : null;

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tournament_edit', array('id' => $tournament->getId()));
        }

        return $this->render('tournament/admin_edit.html.twig', array(
            'tournament' => $tournament,
            'edit_game_form' => $editGameFormView,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tournament entity.
     *
     * @Route("admin/tournament/{id}", name="admin_tournament_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tournament $tournament)
    {
        $form = $this->createDeleteForm($tournament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tournament);
            $em->flush();
        }

        return $this->redirectToRoute('tournament_index');
    }

    /**
     * Creates a form to delete a tournament entity.
     *
     * @param Tournament $tournament The tournament entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tournament $tournament)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_tournament_delete', array('id' => $tournament->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
