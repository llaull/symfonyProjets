<?php

namespace ddaBundle\ArtisteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BioElement
 *
 * @ORM\Table(name="dda__artiste_bio_element")
 * @ORM\Entity(repositoryClass="ddaBundle\ArtisteBundle\Repository\BioElementRepository")
 */
class BioElement
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
     * @var \ddaBundle\ArtisteBundle\Entity\BioCategorie
     *
     * @ORM\ManyToOne(targetEntity="\ddaBundle\ArtisteBundle\Entity\BioCategorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categorie_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $categorie;

    /**
     * @return BioCategorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param BioCategorie $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

