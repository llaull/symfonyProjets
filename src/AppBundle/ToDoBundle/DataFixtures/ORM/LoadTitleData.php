<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 21/10/2016
 * Time: 19:37
 */

namespace AppBundle\ToDoBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\ToDoBundle\Entity\Title;

class LoadTitleData implements FixtureInterface
{
    public function load(ObjectManager $manager)
{
    $title = new Title();
    $title->setName('test');

    $manager->persist($title);
    $manager->flush();
}
}
