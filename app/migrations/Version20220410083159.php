<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220410083159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campervan ADD order_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE campervan ADD CONSTRAINT FK_6891BB7F8D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id)');
        $this->addSql('CREATE INDEX IDX_6891BB7F8D9F6D38 ON campervan (order_id)');
        $this->addSql('ALTER TABLE orders CHANGE state state VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE campervan DROP FOREIGN KEY FK_6891BB7F8D9F6D38');
        $this->addSql('DROP INDEX IDX_6891BB7F8D9F6D38 ON campervan');
        $this->addSql('ALTER TABLE campervan DROP order_id');
        $this->addSql('ALTER TABLE orders CHANGE state state VARCHAR(16) NOT NULL');
    }
}
