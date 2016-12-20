<?php

namespace ddaBundle\ArtisteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TexteControllerTest extends WebTestCase
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
        $crawler = $client->request('GET', '/admin/artiste/texte/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /admin/artiste/texte/");
        $crawler = $client->click($crawler->selectLink('Ajouter')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Créer')->form(array(
            'ddabundle_artistebundle_texte[date]' => '2001-12-12',
            'ddabundle_artistebundle_texte[titre]' => 'titreTest',
            'ddabundle_artistebundle_texte[contenu]'  => 'contenuTest',
            'ddabundle_artistebundle_texte[auteur]' => 'moi'
        ));


        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("moi")')->count(), 'Missing element td:contains("moi")');


    }

}