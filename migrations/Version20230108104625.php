<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230108104625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clothes ADD size_id INT NOT NULL, ADD color_id INT NOT NULL');
        $this->addSql('ALTER TABLE clothes ADD CONSTRAINT FK_3079B48C498DA827 FOREIGN KEY (size_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE clothes ADD CONSTRAINT FK_3079B48C7ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
        $this->addSql('CREATE INDEX IDX_3079B48C498DA827 ON clothes (size_id)');
        $this->addSql('CREATE INDEX IDX_3079B48C7ADA1FB5 ON clothes (color_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clothes DROP FOREIGN KEY FK_3079B48C7ADA1FB5');
        $this->addSql('ALTER TABLE clothes DROP FOREIGN KEY FK_3079B48C498DA827');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP INDEX IDX_3079B48C498DA827 ON clothes');
        $this->addSql('DROP INDEX IDX_3079B48C7ADA1FB5 ON clothes');
        $this->addSql('ALTER TABLE clothes DROP size_id, DROP color_id');
    }
}
