<?php

namespace AppBundle\BackBundle\Services;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class LoggService extends WebTestCase{

    /**
     * var_dump($client->getResponse()->getContent());
     * @param $client
     * @param string $username
     * @param string $password
     */
    public function logIn($client, $username = 'test', $password = 'test')
    {
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('_submit')->form(array(
            '_username' => $username,
            '_password' => $password,
        ));
        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect());
    }
}
