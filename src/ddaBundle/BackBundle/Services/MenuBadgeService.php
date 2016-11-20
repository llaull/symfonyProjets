<?php


namespace ddaBundle\BackBundle\Services;

use Doctrine\ORM\EntityManager;

class MenuBadgeService
{

    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }


    public function getArtisteNotActived()
    {
        $artistes = $this->em->getRepository('ddaBundleArtisteBundle:Artiste');
        $artisteNotActived = $artistes->getNoActiveCount();

        if ($artisteNotActived != 0)
            return '<span class="badge badge-warning">' . $artisteNotActived . "</span>";
        else
            return "";
    }


}
