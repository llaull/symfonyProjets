<?php

namespace ddaBundle\ArtisteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Artiste
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="dda__artiste")
 * @ORM\Entity(repositoryClass="ddaBundle\ArtisteBundle\Repository\ArtisteRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Artiste
{
    /**
     * @Gedmo\Slug(fields={"prenom", "nom"})
     * @Doctrine\ORM\Mapping\Column(length=128, unique=true)
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
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $creator;
    /**
     * @var datetime $dateDeNaissance
     *
     * @ORM\Column(name="dateDeNaissance", type="datetime", nullable=true)
     */
    private $dateDeNaissance;
    /**
     * @var datetime $dateDeDeces
     *
     * @ORM\Column(name="deteDeDeces", type="datetime", nullable=true)
     */
    private $dateDeDeces;
    /**
     * @var string
     * @ORM\Column(name="collectif", type="string", length=255, nullable=true)
     */
    private $collectif;
    /**
     * @var string
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;
    /**
     * @var string
     * @ORM\Column(name="prenom", type="string", length=255, nullable=false)
     */
    private $prenom;
    /**
     * @var string
     * @ORM\Column(name="rue", type="string", length=255, nullable=true)
     */
    private $rue;
    /**
     * @var string
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;
    /**
     * @var string
     * @ORM\Column(name="codePostale", type="string", length=255, nullable=true)
     */
    private $postePostale;
    /**
     * @var string
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    private $telephone;
    /**
     * @var string
     * @ORM\Column(name="fax", type="string", length=255, nullable=true)
     */
    private $fax;
    /**
     * @var string
     * @ORM\Column(name="portable", type="string", length=255, nullable=true)
     */
    private $portable;
    /**
     * @var string
     * @ORM\Column(name="mail", type="string", length=350, nullable=true)
     */
    private $mail;
    /**
     * @var string
     * @ORM\Column(name="site", type="string", length=255, nullable=true)
     */
    private $site;
    /**
     * @var string
     * @ORM\Column(name="SOAmoteCle", type="string", length=255, nullable=true)
     */
    private $moteCle;
    /**
     * @var string
     * @ORM\Column(name="lieuTravail", type="string", length=255, nullable=true)
     */
    private $lieuTravail;
    /**
     * @var string
     * @ORM\Column(name="dep", type="string", length=255, nullable=true)
     */
    private $dep;
    /**
     * @var string
     * @ORM\Column(name="lieuNaissance", type="string", length=255, nullable=true)
     */
    private $lieuNaissance;
    /**
     * @var string
     * @ORM\Column(name="nationalite", type="string", length=255, nullable=true)
     */
    private $nationalite;
    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean", nullable=true, options={"default":false})
     */
    private $active;
    /**
     * @var string
     * @ORM\Column(name="lieuDeces", type="string", length=255, nullable=true)
     */
    private $lieuDeces;
    /**
     * @var string
     * @ORM\Column(name="paysMort", type="string", length=255, nullable=true)
     */
    private $paysMort;

    /**
     * @ORM\Column(type="text", nullable=true, options={"default":NULL})
     */
    private $popUpText;

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
        $this->dateDeNaissance = new \DateTime();
        $this->dateDeDeces = NULL;
    }

    /**
     * @return mixed
     */
    public function getPopUpText()
    {
        return $this->popUpText;
    }

    /**
     * @param mixed $popUpText
     */
    public function setPopUpText($popUpText)
    {
        $this->popUpText = $popUpText;
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
     * @return datetime
     */
    public function getdateDeNaissance()
    {
        return $this->dateDeNaissance;
    }

    /**
     * @param datetime $dateDeNaissance
     */
    public function setdateDeNaissance($dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;
    }

    /**
     * @return datetime
     */
    public function getDateDeDeces()
    {
        return $this->dateDeDeces;
    }

    /**
     * @param datetime $dateDeDeces
     */
    public function setDateDeDeces($dateDeDeces)
    {
        $this->dateDeDeces = $dateDeDeces;
    }

    /**
     * @return string
     */
    public function getCollectif()
    {
        return $this->collectif;
    }

    /**
     * @param string $collectif
     */
    public function setCollectif($collectif)
    {
        $this->collectif = $collectif;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param string $rue
     */
    public function setRue($rue)
    {
        $this->rue = $rue;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return string
     */
    public function getPostePostale()
    {
        return $this->postePostale;
    }

    /**
     * @param string $postePostale
     */
    public function setPostePostale($postePostale)
    {
        $this->postePostale = $postePostale;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return string
     */
    public function getPortable()
    {
        return $this->portable;
    }

    /**
     * @param string $portable
     */
    public function setPortable($portable)
    {
        $this->portable = $portable;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param string $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param string $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }

    /**
     * @return string
     */
    public function getMoteCle()
    {
        return $this->moteCle;
    }

    /**
     * @param string $moteCle
     */
    public function setMoteCle($moteCle)
    {
        $this->moteCle = $moteCle;
    }

    /**
     * @return string
     */
    public function getLieuTravail()
    {
        return $this->lieuTravail;
    }

    /**
     * @param string $lieuTravail
     */
    public function setLieuTravail($lieuTravail)
    {
        $this->lieuTravail = $lieuTravail;
    }

    /**
     * @return string
     */
    public function getDep()
    {
        return $this->dep;
    }

    /**
     * @param string $dep
     */
    public function setDep($dep)
    {
        $this->dep = $dep;
    }

    /**
     * @return string
     */
    public function getLieuNaissance()
    {
        return $this->lieuNaissance;
    }

    /**
     * @param string $lieuNaissance
     */
    public function setLieuNaissance($lieuNaissance)
    {
        $this->lieuNaissance = $lieuNaissance;
    }

    /**
     * @return string
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * @param string $nationalite
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;
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
     * @return string
     */
    public function getLieuDeces()
    {
        return $this->lieuDeces;
    }

    /**
     * @param string $lieuDeces
     */
    public function setLieuDeces($lieuDeces)
    {
        $this->lieuDeces = $lieuDeces;
    }

    /**
     * @return string
     */
    public function getPaysMort()
    {
        return $this->paysMort;
    }

    /**
     * @param string $paysMort
     */
    public function setPaysMort($paysMort)
    {
        $this->paysMort = $paysMort;
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

    public function __toString()
    {
        return $this->prenom . " " . $this->nom;
    }
}
