<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230115132623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clothes DROP FOREIGN KEY FK_3079B48C498DA827');
        $this->addSql('DROP INDEX IDX_3079B48C498DA827 ON clothes');
        $this->addSql('ALTER TABLE clothes DROP size_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clothes ADD size_id INT NOT NULL');
        $this->addSql('ALTER TABLE clothes ADD CONSTRAINT FK_3079B48C498DA827 FOREIGN KEY (size_id) REFERENCES size (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3079B48C498DA827 ON clothes (size_id)');
    }
}
