<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211122080733 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE slug slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE product CHANGE name name VARCHAR(500) NOT NULL, CHANGE description description VARCHAR(3000) NOT NULL, CHANGE slug slug VARCHAR(1000) NOT NULL, CHANGE disc_price disc_price INT DEFAULT NULL, CHANGE components_comport components_comport VARCHAR(500) DEFAULT NULL, CHANGE consumable_ware consumable_ware VARCHAR(255) DEFAULT NULL, CHANGE weight weight INT DEFAULT NULL, CHANGE width width INT DEFAULT NULL, CHANGE height height INT DEFAULT NULL, CHANGE length length INT DEFAULT NULL');
        $this->addSql('ALTER TABLE property CHANGE type type VARCHAR(10000) NOT NULL');
        $this->addSql('ALTER TABLE user ADD email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE slug slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE product CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(2000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE slug slug LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE disc_price disc_price INT NOT NULL, CHANGE components_comport components_comport VARCHAR(1000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE consumable_ware consumable_ware VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE weight weight DOUBLE PRECISION NOT NULL, CHANGE width width DOUBLE PRECISION NOT NULL, CHANGE height height DOUBLE PRECISION NOT NULL, CHANGE length length DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE property CHANGE type type LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP email');
    }
}
