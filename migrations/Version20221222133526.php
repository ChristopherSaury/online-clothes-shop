<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221222133526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD country_id INT DEFAULT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD address VARCHAR(255) NOT NULL, ADD building_floor VARCHAR(255) DEFAULT NULL, ADD city VARCHAR(255) NOT NULL, ADD postcode INT NOT NULL, ADD phone INT NOT NULL, ADD birthdate DATE NOT NULL, ADD creation_date DATETIME NOT NULL, ADD terms_of_use TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649F92F3E70 ON user (country_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649F92F3E70');
        $this->addSql('DROP INDEX IDX_8D93D649F92F3E70 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP country_id, DROP firstname, DROP lastname, DROP address, DROP building_floor, DROP city, DROP postcode, DROP phone, DROP birthdate, DROP creation_date, DROP terms_of_use');
    }
}
