<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170119125210 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $sql = <<<'EOD'
        UPDATE  `app__options` SET  `option_value` =  'Domobox dashboard 2016 &copy; <a href="#" title="" target="_blank"> projet ! </a>' WHERE  `app__options`.`option_id` =5;
EOD;
        $this->addSql($sql);


        $sql = <<<'EOD'
        UPDATE  `app__options` SET  `option_value` =  'Domobox |' WHERE  `app__options`.`option_id` =4;
EOD;
        $this->addSql($sql);

        $sql = <<<'EOD'
        UPDATE `app__options` SET  `option_value` =  'domobox' WHERE  `app__options`.`option_id` =6;
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
