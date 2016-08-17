<?php

namespace AppBundle\BackBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileChangePwdTest extends WebTestCase
{

    public function testIndex()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $client = static::createClient();
        $s = $container->get('back_office.loging');
        $s->logIn($client);

        // Create a new entry in the database
        $crawler = $client->request('GET', '/profile/change-password');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /profile/edit");

        $form = $crawler->selectButton('Sauvegarder')->form(array(
            'fos_user_change_password_form[current_password]'  => 'test',
            'fos_user_change_password_form[plainPassword][first]'  => 'test',
            'fos_user_change_password_form[plainPassword][second]'  => 'test',
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();


        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('div:contains("test")')->count(), 'Missing element td:contains("test")');

    }
}
