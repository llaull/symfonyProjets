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
     * @var \ddaBundle\ArtisteBundle\Entity\Artiste
     *
     * @ORM\OneToOne(targetEntity="\ddaBundle\ArtisteBundle\Entity\Artiste")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="artiste_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $artiste;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenu;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean", nullable=true, options={"default":false})
     */
    private $active;
}

