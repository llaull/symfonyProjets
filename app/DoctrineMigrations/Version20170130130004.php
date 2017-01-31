<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170130130004 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $sql = <<<'EOD'
        INSERT INTO `app__options` (`option_id`, `option_name`, `option_value`, `option_updated`, `option_modifieur_ID`)  VALUES
        (NULL, 'domobox.kazer.id', 'x', NOW(), '1'),
        (NULL, 'app.systeme.mail', 'w@z.y', NOW(), '1'),
        (NULL, 'domobox.mail.commun', 'z@z.y', NOW(), '1')
        ;
EOD;
        $this->addSql($sql);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
