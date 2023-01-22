<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120144649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clothes_size DROP FOREIGN KEY FK_C885B503271E85C0');
        $this->addSql('ALTER TABLE clothes_size DROP FOREIGN KEY FK_C885B503498DA827');
        $this->addSql('DROP TABLE clothes_size');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clothes_size (clothes_id INT NOT NULL, size_id INT NOT NULL, INDEX IDX_C885B503271E85C0 (clothes_id), INDEX IDX_C885B503498DA827 (size_id), PRIMARY KEY(clothes_id, size_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE clothes_size ADD CONSTRAINT FK_C885B503271E85C0 FOREIGN KEY (clothes_id) REFERENCES clothes (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clothes_size ADD CONSTRAINT FK_C885B503498DA827 FOREIGN KEY (size_id) REFERENCES size (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
