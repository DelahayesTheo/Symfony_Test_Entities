<?php

namespace travelAdvisorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/voyage/",
     *     name="voyage_homepage")
     */
    public function indexAction()
    {
        return $this->render('travelAdvisorBundle:Default:index.html.twig');
    }

    /**
     * @Route("/voyage/{votrePrenom}/", name="afficher_prenom")
     */
    public function afficherPrenomAction($votrePrenom)
    {
        return $this->render('travelAdvisorBundle:Default:index.html.twig', array(
            "prenom" => $votrePrenom
        ));
    }
}
