<?php

namespace travelAdvisorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class equipementControlleur extends Controller
{
    /**
     * @Route("/equipement/ajoutEtablissement/{id}/",
     *     name="equipment_add_etablissement")
     */
    public function addEtablissement($id)
    {
        $message = null;
        $em = $this
            ->getDoctrine()
            ->getManager();

        $etablissementRepository = $em->getRepository("travelAdvisorBundle:Etablissement");
        $equipementRepository = $em->getRepository("travelAdvisorBundle:Equipement");

        $etablissement = $etablissementRepository->findOneBy(array("id"=>$id));
        $equipement = $equipementRepository->findOneBy(array(), array("id"=>"DESC"));

        if(!empty($equipement) && !empty($etablissement)) {
            $verif = $etablissement->getEquipements()->contains($equipement);
            if (!$verif) {
                $message = "l'ajout est un succès";
                $etablissement->setEquipements($equipement);
                $em->persist($etablissement);
                $em->flush();
            } else {
                $message = "la liaison est déjà faite entre l'établissement " . $etablissement->getId() . " et le dernier equipement ajouté";
            }
        } else {
            $message = "L'équipement ou l'établissement n'existe pas";
        }

        return $this->render("travelAdvisorBundle:Equipement:addEtablissement.html.twig", array(
            "message" => $message,
            "equipement" => $equipement
        ));
    }
}