<?php

namespace ddaBundle\ArtisteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Texte
 *
 * @ORM\Table(name="dda__artiste_texte")
 * @ORM\Entity(repositoryClass="ddaBundle\ArtisteBundle\Repository\TexteRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Texte
{
    /**
     * @Gedmo\Slug(fields={"titre"})
     * @Doctrine\ORM\Mapping\Column(length=128, unique=false)
     */
    private $slug;
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
     * @var \AppBundle\BackBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\BackBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=false)
     * })
     */
    private $creator;
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
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean", nullable=true, options={"default":false})
     */
    private $active;
    /**
     * @var boolean
     *
     * @ORM\Column(name="commande", type="boolean", nullable=true, options={"default":false})
     */
    private $commande;
    /**
     * @var string
     * @ORM\Column(name="date", type="string", length=255, nullable=true)
     */
    private $date;
    /**
     * @var string
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    private $titre;
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenu;
    /**
     * @var boolean
     *
     * @ORM\Column(name="isNormalise", type="boolean", nullable=false, options={"default":false})
     */
    private $normalise;
    /**
     * @var string
     * @ORM\Column(name="auteur", type="string", length=255, nullable=true)
     */
    private $auteur;

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
    }

    /**
     * @return boolean
     */
    public function getNormalise()
    {
        return $this->normalise;
    }

    /**
     * @param boolean $normalise
     */
    public function setNormalise($normalise)
    {
        $this->normalise = $normalise;
    }

    /**
     * @return string
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param string $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return \AppBundle\BackBundle\Entity\User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param \AppBundle\BackBundle\Entity\User $creator
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
    }

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
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return boolean
     */
    public function isCommande()
    {
        return $this->commande;
    }

    /**
     * @param boolean $commande
     */
    public function setCommande($commande)
    {
        $this->commande = $commande;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        if ($this->getNormalise())
            return $this->contenu;
        else
            return html_entity_decode($this->contenu);
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdated(new \DateTime('now'));

        if ($this->getUpdated() === null) {
            $this->setUpdated(new \DateTime('now'));
        }
    }

    /**
     * @return datetime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param datetime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }
}

