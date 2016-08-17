<?php
/**
 * Created by PhpStorm.
 * User: adin
 * Date: 19/04/2016
 * Time: 22:42
 */

namespace AppBundle\ToDoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="doto__task")
 */
class Task
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var \AppBundle\ToDoBundle\Entity\Title
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\ToDoBundle\Entity\Title")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="title_id", referencedColumnName="id")
     * })
     */
    private $title;
    /**
     * @var \AppBundle\ToDoBundle\Entity\Description
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\ToDoBundle\Entity\Description")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="description_id", referencedColumnName="id")
     * })
     */
    private $description;
    /**
     * @var \AppBundle\ToDoBundle\Entity\Tag
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\ToDoBundle\Entity\Tag")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tag_id", referencedColumnName="id")
     * })
     */
    private $tag;
    /**
     * @var \AppBundle\BackBundle\Entity\User
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\BackBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function __construct()
    {
        $this->title = new ArrayCollection();
        $this->description = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }
    /**
     * @return \AppBundle\BackBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \AppBundle\BackBundle\Entity\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    public function __toString()
    {
        return $this->title->getName();
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
     * @return Title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param Title $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return Description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param Description $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return Tag
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param Tag $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }

}
