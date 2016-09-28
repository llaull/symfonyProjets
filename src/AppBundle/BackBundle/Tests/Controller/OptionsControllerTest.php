<?php

namespace AppBundle\BackBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OptionsControllerTest extends WebTestCase
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
        $crawler = $client->request('GET', '/admin/options/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /admin/options/");
        $crawler = $client->click($crawler->selectLink('Ajouter')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Créer')->form(array(
            'options[name]' => 'TestName',
            'options[value]' => 'TestValue'
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("TestName")')->count(), 'Missing element td:contains("TestName")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Editer')->link());

        $form = $crawler->selectButton('Sauvegarder')->form(array(
            'options[name]' => 'ReTestName',
            'options[value]' => 'ReTestValue'
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertGreaterThan(0, $crawler->filter('td:contains("ReTestName")')->count(), 'Missing element td:contains("ReTestName")');

    }


}
