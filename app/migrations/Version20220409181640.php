<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220409181640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campervan CHANGE type type VARCHAR(255) NOT NULL, CHANGE state state VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE equipment CHANGE type type VARCHAR(255) NOT NULL, CHANGE state state VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE orders RENAME INDEX uniq_f52993989395c3f3 TO UNIQ_E52FFDEE9395C3F3');
        $this->addSql('ALTER TABLE orders RENAME INDEX uniq_f529939853721dcb TO UNIQ_E52FFDEE53721DCB');
        $this->addSql('ALTER TABLE orders RENAME INDEX uniq_f52993982ff5eabb TO UNIQ_E52FFDEE2FF5EABB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campervan CHANGE type type VARCHAR(16) NOT NULL, CHANGE state state VARCHAR(16) NOT NULL');
        $this->addSql('ALTER TABLE equipment CHANGE type type VARCHAR(16) NOT NULL, CHANGE state state VARCHAR(16) NOT NULL');
        $this->addSql('ALTER TABLE orders RENAME INDEX uniq_e52ffdee2ff5eabb TO UNIQ_F52993982FF5EABB');
        $this->addSql('ALTER TABLE orders RENAME INDEX uniq_e52ffdee53721dcb TO UNIQ_F529939853721DCB');
        $this->addSql('ALTER TABLE orders RENAME INDEX uniq_e52ffdee9395c3f3 TO UNIQ_F52993989395C3F3');
    }
}
