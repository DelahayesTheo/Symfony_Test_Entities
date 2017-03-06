<?php

namespace travelAdvisorBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Equipement
 *
 * @ORM\Table(name="equipement")
 * @ORM\Entity(repositoryClass="travelAdvisorBundle\Repository\EquipementRepository")
 */
class Equipement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity="travelAdvisorBundle\Entity\Etablissement", mappedBy="equipements")
     *  @ORM\JoinTable(
     *  name="equipement_etablissement",
     *  joinColumns={
     *      @ORM\JoinColumn(name="equipement_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="etablissement_id", referencedColumnName="id")
     *  }
     * )
     */
    protected $etablisementEquip;

    public function __construct()
    {
        $this->etablissementEquip = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getEtablisementEquip()
    {
        return $this->etablisementEquip;
    }

    /**
     * @param mixed $etablisement
     */
    public function addEtablisementEquip(Etablissement $etablissement = null)
    {
        $this->etablisementEquip->add($etablissement);
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Equipement
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    public function __toString()
    {
        return $this->libelle;
    }
}
