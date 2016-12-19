<?php

namespace ddaBundle\ArtisteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Dossier
 *
 * @ORM\Table(name="dda__artiste_dossier")
 * @ORM\Entity(repositoryClass="ddaBundle\ArtisteBundle\Repository\DossierRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Dossier
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
     * @var \ddaBundle\ArtisteBundle\Entity\Dossier
     *
     * @ORM\ManyToOne(targetEntity="\ddaBundle\ArtisteBundle\Entity\Dossier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dossier_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $category;
    /**
     * @var int
     *
     * @ORM\Column(name="ordre", type="integer", nullable=true)
     */
    private $ordre;
    /**
     * @var string
     * @ORM\Column(name="titre", type="string", length=255, nullable=false)
     */
    private $titre;
    /**
     * @var string
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;
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
    /**
     * @var boolean
     *
     * @ORM\Column(name="titreView", type="boolean", nullable=true, options={"default":true})
     */
    private $titreView;
    /**
     * @var boolean
     *
     * @ORM\Column(name="isNormalise", type="boolean", nullable=false, options={"default":false})
     */
    private $normalise;
    /**
     * @var boolean
     *
     * @ORM\Column(name="home", type="boolean", nullable=false, options={"default":false})
     */
    private $home;

    public function __construct()
    {
        $this->created = new \DateTime();
        $this->updated = new \DateTime();
    }

    /**
     * @return boolean
     */
    public function isHome()
    {
        return $this->home;
    }

    /**
     * @param boolean $home
     */
    public function setHome($home)
    {
        $this->home = $home;
    }

    /**
     * @return boolean
     */
    public function isTitreView()
    {
        return $this->titreView;
    }

    /**
     * @param boolean $titreView
     */
    public function setTitreView($titreView)
    {
        $this->titreView = $titreView;
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
     * @return Dossier
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Dossier $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getOrdre()
    {
        return $this->ordre;
    }

    /**
     * @param int $ordre
     */
    public function setOrdre($ordre)
    {
        $this->ordre = $ordre;
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
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {

        if ($this->getNormalise())
            return $this->videoDDAA($this->contenu);
//            return html_entity_decode($this->videoDDAA($this->contenu));
        else
            $p = str_replace("http://medias.dda-aquitaine.org/", "/uploads/", $this->contenu);
            return html_entity_decode($this->videoDDAA($p));
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
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
     * @param $texte
     * @return mixed
     */
    static public function videoDDAA($texte)
    {
        //Délimiteurs
        $marqueurDebutLien = '[-VIDEO-]';
        $marqueurFinLien = '[-VIDEOFIN-]';

        //Délimiteurs
        $Tableau1 = explode($marqueurDebutLien, $texte);
        $Tab_Chemin_Vid = array();

        $i = 0;

        foreach ($Tableau1 as $txt_nondecoup) {
            array_push($Tab_Chemin_Vid, substr($txt_nondecoup, 0, strpos($txt_nondecoup, $marqueurFinLien)));

            $i++;
        }

        for ($j = 1; $j < $i; $j++) {
            $texte = str_replace($marqueurDebutLien . $Tab_Chemin_Vid[$j] . $marqueurFinLien, '<video controls="controls" preload="none"><source src="' . _MEDIA_DIR_ . '' . $Tab_Chemin_Vid[$j] . '" type="video/mp4" /><source src="' . _MEDIA_DIR_ . $Tab_Chemin_Vid[$j] . '.ogv" type="video/ogg" />Vous n\'avez pas de navigateur moderne, donc pas de balise video HTML5 !</video>', $texte);
        }

        return $texte;

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
        return $this->artiste->getSlug().' '.$this->titre;
    }

}
