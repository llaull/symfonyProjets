<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 29/09/2016
 * Time: 17:01
 */

namespace AppBundle\BackBundle\Services;

use Doctrine\ORM\EntityManager;

class AppOptionsService
{

    private $options;
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;

        try {

            $opt = $entityManager->getRepository('BackOfficeBundle:Options')->findAll();
            $this->options = $opt;

        } catch (\Doctrine\DBAL\Exception\TableNotFoundException $e) {
            $this->options = 'error';

        }

    }

    public function getOptionName($name)
    {
        foreach ($this->options as $opt) {
            if ($opt->getName() == $name) {
                return $opt;
            }
        }
        return "";
    }
}
