<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20161004150513 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("INSERT INTO `app__options` (`option_id`, `option_modifier`, `option_name`, `option_value`, `option_updated`) VALUES
        (NULL, '1', 'app.maintenance.mode', '0', NOW()),
        (NULL, '1', 'app.todobundle', '0', NOW()),
        (NULL, '1', 'app.projet.global.quickSlidebar', '0', NOW()),
        (NULL, '1', 'app.projet.global.nom', 'Alpha |', NOW()),
        (NULL, '1', 'app.projet.back.copyright', 'Alpha dashboard 2016', NOW()),
        (NULL, '1', 'app.projet.front.copyright', 'Alpha', NOW())
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
