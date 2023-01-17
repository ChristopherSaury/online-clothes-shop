<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230116130715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shoes (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, shoes_collection_id INT DEFAULT NULL, gender_id INT NOT NULL, category_id INT DEFAULT NULL, color_id INT NOT NULL, model VARCHAR(255) DEFAULT NULL, price DOUBLE PRECISION NOT NULL, description VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, INDEX IDX_14CF819744F5D008 (brand_id), INDEX IDX_14CF81973FF66327 (shoes_collection_id), INDEX IDX_14CF8197708A0E0 (gender_id), INDEX IDX_14CF819712469DE2 (category_id), INDEX IDX_14CF81977ADA1FB5 (color_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shoes ADD CONSTRAINT FK_14CF819744F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE shoes ADD CONSTRAINT FK_14CF81973FF66327 FOREIGN KEY (shoes_collection_id) REFERENCES item_collection (id)');
        $this->addSql('ALTER TABLE shoes ADD CONSTRAINT FK_14CF8197708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE shoes ADD CONSTRAINT FK_14CF819712469DE2 FOREIGN KEY (category_id) REFERENCES item_category (id)');
        $this->addSql('ALTER TABLE shoes ADD CONSTRAINT FK_14CF81977ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shoes DROP FOREIGN KEY FK_14CF819744F5D008');
        $this->addSql('ALTER TABLE shoes DROP FOREIGN KEY FK_14CF81973FF66327');
        $this->addSql('ALTER TABLE shoes DROP FOREIGN KEY FK_14CF8197708A0E0');
        $this->addSql('ALTER TABLE shoes DROP FOREIGN KEY FK_14CF819712469DE2');
        $this->addSql('ALTER TABLE shoes DROP FOREIGN KEY FK_14CF81977ADA1FB5');
        $this->addSql('DROP TABLE shoes');
    }
}
