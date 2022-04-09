<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220409184047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipment ADD station_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', DROP station');
        $this->addSql('ALTER TABLE equipment ADD CONSTRAINT FK_D338D58321BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('CREATE INDEX IDX_D338D58321BDB235 ON equipment (station_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipment DROP FOREIGN KEY FK_D338D58321BDB235');
        $this->addSql('DROP INDEX IDX_D338D58321BDB235 ON equipment');
        $this->addSql('ALTER TABLE equipment ADD station VARCHAR(255) DEFAULT NULL, DROP station_id');
    }
}
