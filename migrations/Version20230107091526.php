<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230107091526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clothes (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, clothe_collection_id INT DEFAULT NULL, category_id INT NOT NULL, gender_id INT NOT NULL, model VARCHAR(255) DEFAULT NULL, price NUMERIC(10, 0) NOT NULL, image VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_3079B48C44F5D008 (brand_id), INDEX IDX_3079B48C167CAF31 (clothe_collection_id), INDEX IDX_3079B48C12469DE2 (category_id), INDEX IDX_3079B48C708A0E0 (gender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clothes_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_collection (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, year DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clothes ADD CONSTRAINT FK_3079B48C44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE clothes ADD CONSTRAINT FK_3079B48C167CAF31 FOREIGN KEY (clothe_collection_id) REFERENCES item_collection (id)');
        $this->addSql('ALTER TABLE clothes ADD CONSTRAINT FK_3079B48C12469DE2 FOREIGN KEY (category_id) REFERENCES clothes_category (id)');
        $this->addSql('ALTER TABLE clothes ADD CONSTRAINT FK_3079B48C708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('ALTER TABLE user CHANGE birthdate birthdate VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clothes DROP FOREIGN KEY FK_3079B48C44F5D008');
        $this->addSql('ALTER TABLE clothes DROP FOREIGN KEY FK_3079B48C167CAF31');
        $this->addSql('ALTER TABLE clothes DROP FOREIGN KEY FK_3079B48C12469DE2');
        $this->addSql('ALTER TABLE clothes DROP FOREIGN KEY FK_3079B48C708A0E0');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE clothes');
        $this->addSql('DROP TABLE clothes_category');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE item_collection');
        $this->addSql('ALTER TABLE `user` CHANGE birthdate birthdate DATE NOT NULL');
    }
}
