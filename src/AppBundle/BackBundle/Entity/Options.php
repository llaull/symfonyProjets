<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 27/09/2016
 * Time: 22:13
 */

namespace AppBundle\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="app__options")
 * @ORM\HasLifecycleCallbacks
 */
class Options
{

    /**
     * @ORM\Id
     * @ORM\Column(name="option_id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="option_name", type="string", length=100, nullable=true, unique=true)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(name="option_value", type="string", length=100, nullable=true)
     */
    protected $value;

    /**
     * @var datetime $created
     *
     * @ORM\Column(name="option_updated", type="datetime", nullable=false)
     */
    protected $updated;

    /**
     * @var \AppBundle\BackBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\BackBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="option_modifieur_ID", referencedColumnName="id", nullable=false)
     * })
     */
    private $user;

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
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

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
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

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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
}
