<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230107190335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item_category (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_6A41D10AC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_category ADD CONSTRAINT FK_6A41D10AC54C8C93 FOREIGN KEY (type_id) REFERENCES item_type (id)');
        $this->addSql('ALTER TABLE clothes ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE clothes ADD CONSTRAINT FK_3079B48C12469DE2 FOREIGN KEY (category_id) REFERENCES item_category (id)');
        $this->addSql('CREATE INDEX IDX_3079B48C12469DE2 ON clothes (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clothes DROP FOREIGN KEY FK_3079B48C12469DE2');
        $this->addSql('ALTER TABLE item_category DROP FOREIGN KEY FK_6A41D10AC54C8C93');
        $this->addSql('DROP TABLE item_category');
        $this->addSql('DROP TABLE item_type');
        $this->addSql('DROP INDEX IDX_3079B48C12469DE2 ON clothes');
        $this->addSql('ALTER TABLE clothes DROP category_id');
    }
}
