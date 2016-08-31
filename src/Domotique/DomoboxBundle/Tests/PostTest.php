<?php
/**
 * Created by PhpStorm.
 * User: hazardl
 * Date: 04/02/2016
 * Time: 17:12
 */

namespace Domotique\DomoboxBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class PostTest extends WebTestCase
{

    /*
     * var_dump($client->getResponse()->getContent());
     */
    public function testIndex()
    {
        $client = static::createClient();

        // données simulé
        $datas = array(
            "mac" => "010007804000",
            "ipv4" => "10.0.0.01",
            "iterator" => "1",
            "debug txt" => "sucess",
            "sensors" => array(
                "sensor Id" => "1",
                "sensor type Id" => "8",
                "sensor unit Id" => "7",
                "sensor value" => "1"),
            array(
                "sensor Id" => "2",
                "sensor type Id" => "7",
                "sensor unit Id" => "7",
                "sensor value" => "1")
        );

        $client->request(
            'POST',
            '/module/esp8266/post/json/',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            json_encode($datas)
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected create test");
    }
}
