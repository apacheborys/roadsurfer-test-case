<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407171627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE campervan (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', plate_number VARCHAR(12) NOT NULL, meta_data JSON NOT NULL, type VARCHAR(16) NOT NULL, state VARCHAR(16) NOT NULL, station VARCHAR(255) DEFAULT NULL, price_amount INT NOT NULL, price_currency_code VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', meta_data JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipment (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', type VARCHAR(16) NOT NULL, meta_data JSON NOT NULL, state VARCHAR(16) NOT NULL, station VARCHAR(255) DEFAULT NULL, price_amount INT NOT NULL, price_currency_code VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', customer_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', start_station_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', end_station_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, meta_data JSON NOT NULL, state VARCHAR(16) NOT NULL, UNIQUE INDEX UNIQ_F52993989395C3F3 (customer_id), UNIQUE INDEX UNIQ_F529939853721DCB (start_station_id), UNIQUE INDEX UNIQ_F52993982FF5EABB (end_station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', location_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', meta_data JSON NOT NULL, UNIQUE INDEX UNIQ_9F39F8B164D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939853721DCB FOREIGN KEY (start_station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993982FF5EABB FOREIGN KEY (end_station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B164D218E FOREIGN KEY (location_id) REFERENCES location (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993989395C3F3');
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B164D218E');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939853721DCB');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993982FF5EABB');
        $this->addSql('DROP TABLE campervan');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE station');
    }
}
