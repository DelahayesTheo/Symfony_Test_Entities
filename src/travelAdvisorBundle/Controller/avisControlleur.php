<?php

namespace travelAdvisorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use travelAdvisorBundle\Entity\Membre;
use travelAdvisorBundle\Entity\Avis;
class avisControlleur extends Controller
{
    /**
     * @Route("/avis/",
     *     name="afficher_avis")
     */
    public function displayAvis()
    {
        $message = null;
        $em = $this
            ->getDoctrine()
            ->getManager();

        $avisRepository = $em->getRepository("travelAdvisorBundle:Avis");
        $avisUn = $avisRepository->findOneBy(array("id"=>1));

        if (!empty($avisUn)) {
            $message = "Voici l'affichage de l'avis 1 et des entités liés";
        } else {
            $message = "l'avis 1 n'existe pas encore, rien à afficher";
        }

        return $this->render("travelAdvisorBundle:Avis:display.html.twig", array(
            "message" => $message,
            "avis" => $avisUn
        ));
    }
    /**
     * @Route("/avis/{x}",
     *     name="boucle_avis")
     */
    public function avisBoucleAction($x)
    {
        return $this->render("travelAdvisorBundle:Avis:boucle.html.twig", array(
            "x" => $x
        ));
    }

    /**
     * @Route("/ajoutAvis/",
     *     name="add_avis")
     */
    public function addAvisAction()
    {
        $message = null;
        $em = $this
            ->getDoctrine()
            ->getManager();

        $membreRepository = $em
            ->getRepository("travelAdvisorBundle:Membre");

        $avisRepository = $em
            ->getRepository("travelAdvisorBundle:Avis");

        $membre = $membreRepository->findOneBy(array('id' => 1));

        if (!empty($membre)) {
            $avis = new Avis();

            $avis->setMembre($membre);
            $avis->setCommentaire("un avis");
            $avis->setNote(5);
            $avis->setTitre("mon avis");
            $avis->setDate(new \DateTime());
            $em->persist($avis);
            $em->flush();
            $message = "L'avis à été créer";

        } else {
            $message = "l'utilisateur n'existe pas";
        }
        $lesAvis = $avisRepository->findBy(array("membre" => 1));

        return $this->render("travelAdvisorBundle:Avis:add.html.twig", array(
            "message" => $message,
            "lesAvis" => $lesAvis
        ));
    }
}