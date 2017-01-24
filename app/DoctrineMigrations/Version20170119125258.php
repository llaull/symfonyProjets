<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170119125258 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO `domotique__sensor_type` (`id`, `name`) VALUES
        (1, 'systeme'),
        (2, 'DHT11'),
        (3, 'DHT22'),
        (4, 'BMP'),
        (5, 'PIR_sonde'),
        (6, 'Luxmetre'),
        (7, 'matrixR8'),
        (8, 'RubanRGB'),
        (9, 'webcam');
        ");

        $this->addSql("INSERT INTO `domotique__module_emplacement` (`id`, `name`, `isPublic`) VALUES
        (1, 'salon', 1),
        (2, 'test', 0),
        (3, 'bureau', 0),
        (4, 'Buanderie', 0),
        (5, 'Chambre 1', 0),
        (6, 'Balcon', 0);
        ");



        $this->addSql("INSERT INTO `domotique__sensor_unit` (`id`, `symbole`, `name`) VALUES
        (1, 'V', 'Tension '),
        (2, '°C', 'Température'),
        (3, '%', 'Humidité'),
        (4, 'hPa', 'Baromètre'),
        (5, 'm', 'Altimetre'),
        (6, 'lux', 'Luminosité'),
        (7, 'ping', 'Implusion'),
        (8, 'hex', 'couleurHEXA'),
        (9, 't', 'Test');
        ");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
