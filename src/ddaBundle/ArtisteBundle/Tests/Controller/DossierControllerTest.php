<?php

namespace ddaBundle\ArtisteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DossierControllerTest extends WebTestCase
{

    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $client = static::createClient();
        $s = $container->get('back_office.loging');
        $s->logIn($client);

        // Create a new entry in the database
        $crawler = $client->request('GET', '/admin/artiste/dossier/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /admin/artiste/dossier/");
        $crawler = $client->click($crawler->selectLink('Ajouter')->link());


        // Fill in the form and submit it
        $form = $crawler->selectButton('Créer')->form(array(
            'ddabundle_artistebundle_dossier[titre]'  => 'titreTest',
            'ddabundle_artistebundle_dossier[contenu]'  => 'contenuTest'
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("titreTest")')->count(), 'Missing element td:contains("titreTest")');
    }

}
