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


    public function makeResult($rq)
    {
        if ($rq != 0)
            return '<span class="badge badge-warning">' . $rq . "</span>";
        else
            return "";
    }

    public function getNotActived($entity)
    {
        $entity = $this->em->getRepository('ddaBundleArtisteBundle:'.$entity);
        $entityNotActived = $entity->getNoActiveCount();

        return $this->makeResult($entityNotActived);
    }

}
