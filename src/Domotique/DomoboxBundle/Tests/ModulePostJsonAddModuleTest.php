<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 04/02/2016
 * Time: 17:12
 */

namespace Domotique\DomoboxBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class ModulePostJsonAddModuleTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient();

        static::bootKernel();
        $container = static::$kernel->getContainer();

        // données
        $data = array(
            "mac" => "000000000000",
            "ipv4" => "10.1.1.8",
            "iterator" => "1932",
            "debug txt" => "sucess",
            "sensors" => array(
                array(
                    "sensor Id" => "1",
                    "sensor type Id" => "1",
                    "sensor unit Id" => "7",
                    "sensor value" => "1"),
                array(
                    "sensor Id" => "2",
                    "sensor type Id" => "8",
                    "sensor unit Id" => "7",
                    "sensor value" => "0")
            )
        );

        /*
         * boucle pour inserer plusieurs fois le jeu de donnée
         */
        for ($i = 0; $i <= 2; $i++) {

            $client->request(
                'POST',
                '/module/esp8266/post/json/',
                array(),
                array(),
                array('CONTENT_TYPE' => 'application/json', 'HTTP_X_DOMOBOXAPIKEY' => "XxX"),
                json_encode($data)
            );

            $this->assertEquals(200, $client->getResponse()->getStatusCode());
        }

    }
}
