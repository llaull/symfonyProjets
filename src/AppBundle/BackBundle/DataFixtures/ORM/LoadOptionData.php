<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 21/10/2016
 * Time: 19:26
 */

namespace AppBundle\BackBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\BackBundle\Entity\Options;

class LoadOptionData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $option = new Options();
        $option->setName('test');
        $option->setValue('test.value');

        $manager->persist($option);
        $manager->flush();
    }
}
