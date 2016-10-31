<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 17/10/2016
 * Time: 10:01
 */

namespace ddaBundle\ArtisteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Artiste rendu public des informations
 *
 *
 * @ORM\Entity
 * @ORM\Table(name="dda__artiste_favoris")
 */
class ArtisteInformationFavoris
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
     * @ORM\Column(name="nom", type="string", length=100, nullable=true)
     */
    private $nom;
    /**
     * @var \ddaBundle\ArtisteBundle\Entity\Artiste
     *
     * @ORM\ManyToOne(targetEntity="ddaBundle\ArtisteBundle\Entity\Artiste")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="artiste", referencedColumnName="id", nullable=false)
     * })
     */
    private $artiste;

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

}
