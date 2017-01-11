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
     * @var datetime $created
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;
    /**
     * @var datetime $updated
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated;
    /**
     * @var \AppBundle\UserBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=false)
     * })
     */
    private $creator;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenu;

    /**
     * @var \Year
     *
     * @ORM\Column(name="year", columnDefinition="YEAR", nullable=true)
     */
    private $year;
}

