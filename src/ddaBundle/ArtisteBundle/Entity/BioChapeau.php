<?php

namespace ddaBundle\ArtisteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BioChapeau
 *
 * @ORM\Table(name="dda__artiste_bio_chapeau")
 * @ORM\Entity(repositoryClass="ddaBundle\ArtisteBundle\Repository\BioChapeauRepository")
 */
class BioChapeau
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
     * @var \ddaBundle\ArtisteBundle\Entity\Artiste
     *
     * @ORM\ManyToOne(targetEntity="\ddaBundle\ArtisteBundle\Entity\Artiste")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="artiste_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $artiste;

    /**
     * @return Artiste
     */
    public function getArtiste()
    {
        return $this->artiste;
    }

    /**
     * @param Artiste $artiste
     */
    public function setArtiste($artiste)
    {
        $this->artiste = $artiste;
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

