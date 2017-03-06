<?php

namespace travelAdvisorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use travelAdvisorBundle\Entity\Membre;

class membreControlleur extends Controller
{
    /**
     * @Route("/ajoutMembre/",
     *     name="add_member")
     */
    public function addMemberAction()
    {
        $em = $this
            ->getDoctrine()
            ->getManager();

        $membre = new Membre();
        $membre->setNom("user");
        $membre->setPrenom("utilsateur");
        $membre->setEmail("monemail@mondomaineperso.com");

        $em->persist($membre);
        $em->flush();

        return $this->render("travelAdvisorBundle:Membre:add.html.twig");
    }

    /**
     * @Route("/afficherMembre/",
     *     name="list_member")
     */
    public function listMemberAction()
    {
        $em = $this
            ->getDoctrine()
            ->getManager();

        $memberRepository = $em->getRepository("travelAdvisorBundle:Membre");

        $membres = $memberRepository->findAll();

        return $this->render("travelAdvisorBundle:Membre:list.html.twig", array(
            "members" => $membres
        ));
    }
}