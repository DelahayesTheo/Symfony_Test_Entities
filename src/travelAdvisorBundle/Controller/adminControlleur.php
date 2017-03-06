<?php

namespace travelAdvisorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class adminControlleur extends Controller
{
    /**
     * @Route("/admin/",
     *     name="admin_homepage")
     */
    public function indexAction()
    {
        return $this->render("travelAdvisorBundle:Default:indexAdmin.html.twig");
    }

    /**
     * @Route("/admin/redirection/",
     *     name="admin_redirect")
     */
    public function redirectAction()
    {
        return $this->redirectToRoute("afficher_prenom", array("prenom" => "visiteur"));
    }
}