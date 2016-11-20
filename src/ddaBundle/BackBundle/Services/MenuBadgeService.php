<?php


namespace ddaBundle\BackBundle\Services;

use Doctrine\ORM\EntityManager;

class MenuBadgeService
{

    private $em;
    private $s;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;

        $artistes = $entityManager->getRepository('ddaBundleArtisteBundle:Artiste');
        $artistesNb = $artistes->getActiveCount();
        $artistesNbG = $artistes->getNoActiveCount();

        $this->s = array("a" => $artistesNb, "e" => $artistesNbG);

    }


}
