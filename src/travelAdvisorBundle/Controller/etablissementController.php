<?php

namespace travelAdvisorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use travelAdvisorBundle\Entity\Equipement;
use travelAdvisorBundle\Entity\Etablissement;

class etablissementController extends Controller
{
    /**
     * @Route("/ajoutEtablissement/",
     *     name="add_etablissement")
     */
    public function ajoutEtablissementAction()
    {
        $message = null;
        $em = $this
            ->getDoctrine()
            ->getManager();

        $avisRepository = $em->getRepository("travelAdvisorBundle:Avis");
        $etablissementRepository = $em->getRepository("travelAdvisorBundle:Etablissement");
        $verifAvis = $avisRepository->findOneBy(array('id'=>1));
        if(!empty($verifAvis)) {
            $etablissement = new Etablissement();
            $verifAvis->setEtablissement($etablissement);
            $etablissement->setEmail("monetablissement@amoi.com");
            $etablissement->setTel("06 06 06 06 06");
            $etablissement->setAdresse("2 rue paumé");
            $em->persist($etablissement);
            $em->persist($verifAvis);
            $em->flush();
            $message = "l'avis à été ajouter à l'établissement" . $etablissement->getId();
        } else {
            $message = "aucun avis à ajouter, l'établissement n'as pas été créer";
        }

        $lesetablissement = $etablissementRepository->findAll();

        return $this->render("travelAdvisorBundle:Etablissement:addAvis.html.twig", array(
            "message" => $message,
            "etablissements" => $lesetablissement
        ));
    }

    /**
     * @Route("/etablissement/ajoutEquipement/{libelle}/",
     *     name="etablissement_add_equiment")
     */
    public function ajoutEquipmentAction ($libelle)
    {
        $message = null;
        $em = $this
            ->getDoctrine()
            ->getManager();
        $etablissementRepository = $em->getRepository("travelAdvisorBundle:Etablissement");
        $lastEtablissement = $etablissementRepository->findOneBy(array('id'=>1));
        if(!empty($lastEtablissement)) {
            $equipement = new Equipement();
            $equipement->setLibelle($libelle);
            $lastEtablissement->setEquipements($equipement);
            $em->persist($equipement);
            $em->flush();
            $message = "l'établissement " . $lastEtablissement->getId() . "possède maintenant l'equipement ".$libelle;
        } else {
            $message = "Il n'y as pas d'établissement";
        }

        return $this->render("travelAdvisorBundle:Etablissement:addEquipment.html.twig", array(
            "message" => $message,
            "etablissement" => $lastEtablissement
        ));
    }
}