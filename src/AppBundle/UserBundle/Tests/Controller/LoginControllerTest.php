<?php

namespace AppBundle\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginControllerTest extends WebTestCase
{

    /*
     *
     */
    public function testIndex()
    {
        $kernel = static::createKernel();
        $kernel->boot();

        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form(array(
            '_username' => "test",
            '_password' => "test",
        ));
        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());

    }
}
