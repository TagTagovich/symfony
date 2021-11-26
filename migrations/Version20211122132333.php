<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211122132333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE slug slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product_photo ADD width INT DEFAULT NULL, ADD height INT DEFAULT NULL, ADD type VARCHAR(255) NOT NULL, ADD link VARCHAR(4096) NOT NULL, ADD content LONGTEXT DEFAULT NULL, ADD image_filemane VARCHAR(255) NOT NULL, ADD description VARCHAR(4096) DEFAULT NULL, DROP image_name, CHANGE test_field name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE slug slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product_photo ADD image_name VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD test_field VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP name, DROP width, DROP height, DROP type, DROP link, DROP content, DROP image_filemane, DROP description');
    }
}
