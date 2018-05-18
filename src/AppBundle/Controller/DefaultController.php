<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tournaments = $em->getRepository('AppBundle:Tournament')->findAllLast();

        return $this->render('default/index.html.twig', [
            'tournaments' => $tournaments
        ]);
    }

    /**
     * @Route("/admin", name="admin_homepage")
     */
    public function adminIndexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tournaments = $em->getRepository('AppBundle:Tournament')->findAllLast();

        return $this->render('default/admin_index.html.twig', [
            'tournaments' => $tournaments
        ]);
    }
}
