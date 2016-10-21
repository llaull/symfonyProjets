<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 21/10/2016
 * Time: 16:12
 */

namespace ddaBundle\ArtisteBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ddaBundle\ArtisteBundle\Entity\Artiste;

class LoadArtisteData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $artiste = new Artiste();
        $artiste->setNom('ArtisteNom');
        $artiste->setPrenom('ArtistePrenom');

        $manager->persist($artiste);
        $manager->flush();
    }

}
