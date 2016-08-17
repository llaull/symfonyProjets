<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 08/02/2016
 * Time: 12:48
 */

namespace Domotique\ReseauBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Emplacement
 *
 * @ORM\Table(name="domotique__module_emplacement")
 * @ORM\Entity
 */
class Emplacement {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;


    /**
     * @var boolean
     *
     * @ORM\Column(name="isPublic", type="boolean", nullable=false)
     */
    private $public;

    /**
     * @return boolean
     */
    public function isPublic()
    {
        return $this->public;
    }

    /**
     * @param boolean $public
     */
    public function setPublic($public)
    {
        $this->public = $public;
    }

    public function __toString()
    {
        return $this->name;
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}
