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

    private $em;
    private $options;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;

        $opt = $em->getRepository('BackOfficeBundle:Options')->findAll();

        $this->options = $opt;
    }

    public function getOptionName($name){
        foreach ($this->options as $opt) {
            if ($opt->getName() == $name) {
                return $opt;
            }
        }
        return "";
    }
}