<?php
/**
 * Created by PhpStorm.
 * User: laurent
 * Date: 07/12/2016
 * Time: 21:15
 */

namespace ddaBundle\FrontBundle\Services;

use Doctrine\ORM\EntityManager;

class AlphabetBarService
{

    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param $rq
     * @param $l
     * @return string
     */
    public function makeResult($rq, $l)
    {
        return $rq;
//        die(var_dump($rq));
//        if (count($rq) != 0)
//            return '<a href="#" data="{{ path("front_office_artiste_sss", { "lettre": '.$l.'}) }}" data-toggle="modal">' . $l . "</a>";
//
//        else
//            return '<span>' . $l . '</span>';
    }

    public function getNotActived($lettre)
    {
        $entity = $this->em->getRepository('ddaBundleArtisteBundle:Artiste');
        $entityNotActived = $entity->findByLettreNom($lettre);

        return $this->makeResult($entityNotActived, $lettre);
    }
}