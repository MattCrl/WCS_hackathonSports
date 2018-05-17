<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tournament;
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
        return $this->render('default/index.html.twig', [
        ]);
    }

    /**
     * @Route("/admin", name="admin_homepage")
     */
    public function adminIndexAction(Request $request)
    {
        return $this->render('default/admin_index.html.twig', [
        ]);
    }
}
