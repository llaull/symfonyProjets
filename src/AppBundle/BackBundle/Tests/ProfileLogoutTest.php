<?php

namespace AppBundle\BackBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileLogoutTest extends WebTestCase
{

    public function testIndex()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $client = static::createClient();
        $s = $container->get('back_office.loging');
        $s->logIn($client);

        $crawler = $client->request('GET', '/profile/');
        $link = $crawler->selectLink('Se déconnecter')->link();
        $client->click($link);
        $client->followRedirect();

        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /logout");

    }
}
